<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Models\Provider;
use Throwable;

class ProcessCsvUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    protected $type;

    public function __construct($path, $type)
    {
        $this->path = $path;
        $this->type = $type;
    }

    public function handle(): void
    {
        try {
            $fileContent = Storage::get($this->path);
            if (!$fileContent) {
                Log::warning("CSV processing failed: File not found at path: {$this->path}");
                return;
            }

            $rows = array_map('str_getcsv', preg_split('/\r?\n/', $fileContent));
            $header = array_map('trim', array_shift($rows));
            $headerCount = count($header);

            $modelClass = null;
            if ($this->type === 'companies') {
                $modelClass = Company::class;
            } elseif ($this->type === 'providers') {
                $modelClass = Provider::class;
            }

            if (!$modelClass) {
                Log::warning("CSV processing failed: Invalid type '{$this->type}' specified.");
                return;
            }

            foreach ($rows as $rowIndex => $row) {
                if (count($row) !== $headerCount) {
                    Log::warning("Skipping row " . ($rowIndex + 2) . " due to column count mismatch.", ['path' => $this->path]);
                    continue;
                }

                $data = array_combine($header, $row);
                if ($data === false) {
                    continue;
                }

                // Filtrar solo los campos que existen en el modelo
                $modelFields = (new $modelClass)->getFillable();
                $modelData = [];
                foreach ($modelFields as $field) {
                    // Convertir el nombre del campo del modelo a formato CSV
                    $csvKey = $this->csvKeyForField($field, $header);
                    if ($csvKey && isset($data[$csvKey])) {
                        $modelData[$field] = $data[$csvKey];
                    }
                }

                // Clave única para updateOrCreate
                $uniqueKeys = [];
                if (!empty($modelData['email'])) {
                    $uniqueKeys['email'] = $modelData['email'];
                }
                if (!empty($modelData['company_name'])) {
                    $uniqueKeys['company_name'] = $modelData['company_name'];
                }
                // Si no hay email ni company_name, usar todos los campos posibles para evitar omitir registros
                if (empty($uniqueKeys)) {
                    // Generar una clave única artificial usando el índice de fila
                    $uniqueKeys = ['__row_index' => $rowIndex];
                }

                $modelClass::create($modelData);
            }

        } catch (Throwable $e) {
            Log::error("Error processing CSV file {$this->path}: " . $e->getMessage(), [
                'exception' => $e
            ]);
        } finally {
            // Opcional: Eliminar el archivo después de procesarlo
            // Storage::delete($this->path);
        }
    }

    // Busca el nombre de columna en el CSV que corresponde al campo del modelo
    private function csvKeyForField($field, $header)
    {
        // Mapeo directo: convierte snake_case a Title Case con espacios
        $csvKey = ucwords(str_replace('_', ' ', $field));
        foreach ($header as $h) {
            if (strcasecmp($h, $csvKey) === 0) {
                return $h;
            }
        }
        return null;
    }
}
