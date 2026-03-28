<?php

namespace App\Http\Requests;

use App\Support\CalculatorCatalog;
use App\Support\CountryContext;
use Illuminate\Foundation\Http\FormRequest;

class CalculatorInputRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $calculator = CalculatorCatalog::find((string) $this->route('calculator'));

        if (! $calculator || ! $this->shouldValidate($calculator)) {
            return [];
        }

        return collect($calculator['fields'])
            ->mapWithKeys(fn (array $field, string $name) => [$name => $field['rules']])
            ->all();
    }

    public function messages(): array
    {
        $calculator = CalculatorCatalog::find((string) $this->route('calculator'));

        if (! $calculator) {
            return [];
        }

        return collect($calculator['fields'])
            ->mapWithKeys(fn (array $field, string $name) => [
                "{$name}.required" => $field['label'].' is required.',
            ])
            ->all();
    }

    public function validatedPayload(): array
    {
        $calculator = CalculatorCatalog::find((string) $this->route('calculator'));

        if (! $calculator) {
            return [];
        }

        $defaults = collect($calculator['fields'])
            ->mapWithKeys(function (array $field, string $name) {
                $default = $field['default'] ?? null;

                if ($name === 'country') {
                    $default = app(CountryContext::class)->current()['tax_model'] ?? $default;
                }

                return [$name => $default];
            })
            ->all();

        return array_merge($defaults, $this->validated());
    }

    protected function shouldValidate(array $calculator): bool
    {
        return collect(array_keys($calculator['fields']))
            ->contains(fn (string $field) => $this->filled($field));
    }
}
