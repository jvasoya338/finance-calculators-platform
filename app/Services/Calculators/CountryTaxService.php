<?php

namespace App\Services\Calculators;

class CountryTaxService
{
    public function calculateIncomeTax(string $country, float $grossIncome, float $deductions = 0.0, string $filingStatus = 'single'): array
    {
        $taxableIncome = max(0, $grossIncome - $deductions);

        return match ($country) {
            'us' => $this->forUnitedStates($grossIncome, $taxableIncome, $filingStatus),
            'uk' => $this->forUnitedKingdom($grossIncome, $taxableIncome),
            'in' => $this->forIndia($grossIncome, $taxableIncome),
            default => $this->generic($grossIncome, $taxableIncome, $filingStatus),
        };
    }

    public function calculateTakeHome(string $country, float $grossIncome, float $otherDeductions = 0.0, string $filingStatus = 'single'): array
    {
        $taxData = $this->calculateIncomeTax($country, $grossIncome, 0.0, $filingStatus);
        $social = match ($country) {
            'us' => min($grossIncome, 168600) * 0.062 + ($grossIncome * 0.0145),
            'uk' => $grossIncome <= 12570 ? 0.0 : min(max($grossIncome - 12570, 0), 37700) * 0.08 + max($grossIncome - 50270, 0) * 0.02,
            'in' => max(0, $grossIncome * 0.12),
            default => $grossIncome * 0.05,
        };

        $netAnnual = max(0, $grossIncome - $taxData['tax'] - $social - $otherDeductions);

        return [
            'country' => $taxData['country'],
            'tax' => $taxData['tax'],
            'effective_tax_rate' => $taxData['effective_tax_rate'],
            'social_contributions' => $social,
            'net_annual' => $netAnnual,
            'net_monthly' => $netAnnual / 12,
            'explanation' => $taxData['take_home_explanation'] ?? $taxData['explanation'],
        ];
    }

    protected function forUnitedStates(float $grossIncome, float $taxableIncome, string $filingStatus): array
    {
        $brackets = $filingStatus === 'joint'
            ? [[23200, 0.10], [94300, 0.12], [201050, 0.22], [383900, 0.24], [487450, 0.32], [731200, 0.35], [INF, 0.37]]
            : [[11600, 0.10], [47150, 0.12], [100525, 0.22], [191950, 0.24], [243725, 0.32], [609350, 0.35], [INF, 0.37]];

        $tax = $this->progressive($taxableIncome, $brackets);

        return [
            'country' => 'United States',
            'tax' => $tax,
            'effective_tax_rate' => $grossIncome > 0 ? ($tax / $grossIncome) * 100 : 0,
            'explanation' => 'This estimate uses a simplified U.S.-style federal progressive income tax structure. State and local taxes are not included.',
            'take_home_explanation' => 'This take-home estimate combines simplified U.S. federal income tax with Social Security and Medicare style payroll deductions.',
        ];
    }

    protected function forUnitedKingdom(float $grossIncome, float $taxableIncome): array
    {
        $allowance = 12570;
        $basicBand = 37700;
        $higherBandTop = 125140;
        $tax = 0.0;
        $taxableAfterAllowance = max(0, $taxableIncome - $allowance);

        $tax += min($taxableAfterAllowance, $basicBand) * 0.20;
        $tax += min(max($taxableAfterAllowance - $basicBand, 0), $higherBandTop - $allowance - $basicBand) * 0.40;
        $tax += max($taxableAfterAllowance - ($higherBandTop - $allowance), 0) * 0.45;

        return [
            'country' => 'United Kingdom',
            'tax' => $tax,
            'effective_tax_rate' => $grossIncome > 0 ? ($tax / $grossIncome) * 100 : 0,
            'explanation' => 'This estimate uses a simplified UK-style personal allowance and progressive income tax structure without regional variations.',
            'take_home_explanation' => 'This take-home estimate combines simplified UK income tax with National Insurance style payroll contributions.',
        ];
    }

    protected function forIndia(float $grossIncome, float $taxableIncome): array
    {
        $brackets = [[300000, 0.00], [700000, 0.05], [1000000, 0.10], [1200000, 0.15], [1500000, 0.20], [INF, 0.30]];
        $tax = $this->progressive($taxableIncome, $brackets);
        $cess = $tax * 0.04;

        return [
            'country' => 'India',
            'tax' => $tax + $cess,
            'effective_tax_rate' => $grossIncome > 0 ? (($tax + $cess) / $grossIncome) * 100 : 0,
            'explanation' => 'This estimate uses a simplified India-style new-regime slab structure plus a 4% health and education cess.',
            'take_home_explanation' => 'This take-home estimate combines simplified India-style slab tax with an employee provident fund style retirement deduction.',
        ];
    }

    protected function generic(float $grossIncome, float $taxableIncome, string $filingStatus): array
    {
        $brackets = $filingStatus === 'joint'
            ? [[30000, 0.1], [90000, 0.2], [180000, 0.3], [INF, 0.35]]
            : [[15000, 0.1], [50000, 0.2], [100000, 0.3], [INF, 0.35]];
        $tax = $this->progressive($taxableIncome, $brackets);

        return [
            'country' => 'Generic international model',
            'tax' => $tax,
            'effective_tax_rate' => $grossIncome > 0 ? ($tax / $grossIncome) * 100 : 0,
            'explanation' => 'This uses a generic progressive structure for broad planning purposes where local tax rules are not selected.',
            'take_home_explanation' => 'This take-home estimate uses a generic progressive tax structure with a simple payroll deduction assumption.',
        ];
    }

    protected function progressive(float $income, array $brackets): float
    {
        $tax = 0.0;
        $previousLimit = 0.0;

        foreach ($brackets as [$limit, $rate]) {
            if ($income <= $previousLimit) {
                break;
            }

            $amount = min($income, $limit) - $previousLimit;
            $tax += $amount * $rate;
            $previousLimit = $limit;
        }

        return $tax;
    }
}
