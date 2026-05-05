<?php

namespace App\Support;

class GuideEditorial
{
    public static function forGuide(array $page): array
    {
        $slug = $page['slug'];

        return match ($slug) {
            'mortgage-offers' => self::build(
                'Who this guide helps',
                [
                    'This guide is useful for first-time buyers, households comparing lenders, and anyone trying to understand whether a mortgage is affordable beyond the headline rate. It is especially helpful when a lender quote looks attractive but the monthly payment still feels heavy inside the rest of your budget.',
                    'It also helps people who are comparing more than one offer and want to understand what to focus on first. That might be monthly payment, total interest, fees, flexibility, or how much cash remains after the purchase is complete.',
                ],
                'Worked example',
                [
                    'Imagine two lenders offering similar rates on the same property. One quote produces a slightly lower monthly payment, but also comes with higher upfront fees and stricter prepayment penalties. On paper, the cheaper payment looks better, but the total cost over time may not actually be the stronger option.',
                    'A clearer way to compare the offers is to hold the home price and down payment constant, then review monthly payment, total repayment, and flexibility side by side. This turns the decision into a full-cost comparison rather than a reaction to one attractive number.',
                ],
                [
                    'Keep the property price and down payment the same in the mortgage calculator.',
                    'Test each lender rate and term separately so the results stay comparable.',
                    'Check whether the lower payment still comes with higher fees or weaker flexibility.',
                    'Choose the option that balances monthly comfort, long-term cost, and resilience after purchase.',
                ],
                [
                    'Focusing only on rate and ignoring total repayment.',
                    'Ignoring post-purchase cash needs such as repairs, moving costs, or emergency reserves.',
                    'Comparing one tax-inclusive quote with another quote that uses different assumptions.',
                    'Treating lender approval as proof that the payment is comfortable in real life.',
                ],
                [
                    'Once you narrow the options, use the mortgage and home loan calculators again with slightly higher rates or shorter terms. That stress-test shows whether the loan still feels manageable if conditions change.',
                    'The strongest mortgage decision usually comes from a combination of cost, flexibility, and monthly breathing room. A quote that looks impressive at first glance is not always the one that supports the rest of your financial life best.',
                ],
                [
                    ['question' => 'What matters more: a low monthly payment or lower total repayment?', 'answer' => 'Both matter, but they answer different questions. Monthly payment shows day-to-day comfort while total repayment shows what the borrowing really costs over time.'],
                    ['question' => 'Should I compare fixed and variable offers the same way?', 'answer' => 'You can compare the starting numbers the same way, but you should also consider how much payment uncertainty you are willing to absorb over time.'],
                    ['question' => 'Why does flexibility matter in a mortgage offer?', 'answer' => 'Prepayment rules, refinancing options, and fee structures can change the real value of the loan if your plans shift after purchase.'],
                ]
            ),
            'compounding-time-horizons', 'bitcoin-dca-discipline' => self::build(
                'Who this guide helps',
                [
                    'This guide is useful for people who understand the basic idea of long-term investing but want a clearer sense of what time actually changes in the result. It helps turn an abstract concept into something easier to connect with a monthly contribution or target amount.',
                    'It is also useful for people who feel impatient with early results. Many investing habits are abandoned because the first few years seem too slow, when in reality those years are building the base that later growth depends on.',
                ],
                'Worked example',
                [
                    'Suppose someone contributes the same amount every month for five years and another person continues the same habit for fifteen years. The first plan may feel respectable, but the second plan often benefits much more from the later years when growth starts building on earlier growth.',
                    'This is why time horizon matters so much. The contribution habit remains important, but the later years often change the result more dramatically than most people expect at the beginning.',
                ],
                [
                    'Start with a realistic monthly contribution rather than an ideal one.',
                    'Run one shorter horizon and one longer horizon in the relevant calculator.',
                    'Compare how much of the final value comes from contributions versus estimated growth.',
                    'Use the difference to judge whether more time, more contribution, or a different goal matters most.',
                ],
                [
                    'Expecting compounding to feel dramatic in the first year or two.',
                    'Using a return assumption that is so optimistic it hides the real planning challenge.',
                    'Stopping contributions because early progress looks small.',
                    'Ignoring how withdrawals or inconsistent saving can interrupt the compounding effect.',
                ],
                [
                    'A better long-term plan usually comes from consistency and time rather than prediction. Once you understand that pattern, it becomes easier to judge which goals need more contribution and which ones simply need more runway.',
                    'The same lesson applies whether the asset is a savings product, stock-market fund, retirement account, or crypto DCA plan. Time changes the shape of the outcome much more than most people realize at the start.',
                ],
                [
                    ['question' => 'Why do long horizons matter so much more than short ones?', 'answer' => 'Because later years benefit from returns building on previous returns, which creates acceleration rather than straight-line growth.'],
                    ['question' => 'Should I increase contributions or extend the horizon?', 'answer' => 'It depends on your goal, but running both scenarios usually shows which adjustment has the bigger effect for your situation.'],
                    ['question' => 'Does this mean early returns do not matter?', 'answer' => 'No. Returns matter throughout, but the visible impact often becomes much larger after time has allowed the balance to grow.'],
                ]
            ),
            'monthly-budget-framework', 'take-home-pay-planning', 'salary-offer-net-pay', 'emergency-fund-planning' => self::build(
                'Who this guide helps',
                [
                    'This guide is most useful for people trying to make day-to-day money decisions feel less chaotic. That may include salaried workers, self-employed people, households managing shared bills, or anyone trying to align saving and spending with real monthly cash flow.',
                    'It is especially helpful if the current budget feels reactive rather than planned. A clearer framework often matters more than a more complicated spreadsheet.',
                ],
                'Worked example',
                [
                    'Imagine a household bringing in a fixed monthly amount but feeling unsure where the money goes by the third week of each month. The problem may not be lack of income alone. Often the bigger issue is that essentials, flexible spending, savings, and irregular expenses are mixed together without a clear order.',
                    'Once the monthly cash flow is organized into those layers, the same income becomes easier to manage. A calculator can then show whether the current plan leaves a real surplus, a thin margin, or a monthly gap that needs attention.',
                ],
                [
                    'Start with the amount that actually reaches the account each month, not only the gross headline figure.',
                    'List essential expenses first, then add flexible categories, savings goals, and debt payments.',
                    'Run the budget or salary calculator to see what monthly space remains after the core categories are covered.',
                    'Use that result to decide whether to reduce spending, change a goal timeline, or protect a bigger reserve.',
                ],
                [
                    'Budgeting from gross income instead of real take-home cash flow.',
                    'Treating savings as leftover money instead of assigning it a fixed role in the plan.',
                    'Using goals that look ambitious but are impossible to repeat month after month.',
                    'Ignoring irregular costs until they break the budget unexpectedly.',
                ],
                [
                    'Once the budget is more visible, the next step is not perfection. It is repeatability. A plan that survives ordinary months is more valuable than a strict system that works only briefly.',
                    'That is why these tools work best when paired together. Salary, take-home pay, budget, and emergency-fund planning support one another when you use them as one decision flow instead of isolated pages.',
                ],
                [
                    ['question' => 'Why is take-home pay a better starting point for planning?', 'answer' => 'Because it reflects the money that is actually available for bills, saving, and everyday decisions after deductions are taken out.'],
                    ['question' => 'How often should I review my monthly plan?', 'answer' => 'A light weekly check and a more complete monthly review is enough for many people to stay aware without becoming overwhelmed.'],
                    ['question' => 'What if my budget shows only a tiny margin?', 'answer' => 'That is still useful information. It means you can focus on the largest categories first and protect the essentials before adjusting smaller goals.'],
                ]
            ),
            'debt-payoff-strategy', 'crypto-position-sizing', 'choosing-loan-term', 'down-payment-vs-cash-reserves' => self::build(
                'Who this guide helps',
                [
                    'This guide is useful when the decision is not only mathematical but also emotional. Debt plans, loan terms, down payments, and crypto position sizes all carry pressure because they affect future flexibility as much as they affect the headline number.',
                    'It is especially valuable for people who want a more measured decision process before locking in a plan that may feel uncomfortable later.',
                ],
                'Worked example',
                [
                    'Picture two decisions that both look reasonable at first glance. One is more aggressive and promises a faster or larger result, while the other leaves more breathing room. Without testing the downside, many people choose the more aggressive option simply because it looks better on paper.',
                    'A better decision process compares how each option behaves under normal monthly life. If the more aggressive plan leaves no space for setbacks, it may not actually be the stronger choice even if its headline result looks more impressive.',
                ],
                [
                    'Run the core calculator with a realistic baseline scenario first.',
                    'Test a more aggressive version and a more conservative version of the same decision.',
                    'Compare the result not only by cost or upside, but by how much margin remains in monthly life.',
                    'Choose the version that is strong enough to matter but stable enough to survive ordinary setbacks.',
                ],
                [
                    'Optimizing for the most exciting number instead of the most sustainable plan.',
                    'Ignoring fees, existing obligations, or cash reserves when comparing options.',
                    'Assuming approval or affordability on paper means the plan will feel comfortable in reality.',
                    'Building the plan around optimism instead of resilience.',
                ],
                [
                    'Once you can see the aggressive and conservative versions side by side, the best option usually becomes clearer. A plan that preserves flexibility is often more valuable than one that merely looks stronger in a single metric.',
                    'That is why these pages are decision tools, not only calculators. They help you test the practical cost of being too aggressive before the choice becomes harder to undo.',
                ],
                [
                    ['question' => 'How do I know if a plan is too aggressive?', 'answer' => 'If it leaves little room for normal setbacks, makes the monthly budget feel fragile, or depends on everything going right, it is usually too aggressive.'],
                    ['question' => 'Why compare conservative and aggressive scenarios?', 'answer' => 'Because the comparison reveals how much extra pressure you are taking on for the added benefit.'],
                    ['question' => 'Is the lowest-cost option always the best choice?', 'answer' => 'Not always. A lower-cost option can still be weaker if it removes too much flexibility or creates more monthly strain than you can comfortably manage.'],
                ]
            ),
            'understanding-vat-inclusive-pricing' => self::build(
                'Who this guide helps',
                [
                    'This guide is useful for people checking invoices, pricing quotes, receipts, or transaction totals where tax is already included. It helps remove the confusion between gross totals, net values, and the actual tax portion inside the number.',
                    'It is especially useful for small businesses, freelancers, and everyday buyers who need to compare prices more carefully instead of relying on what the headline total appears to say.',
                ],
                'Worked example',
                [
                    'Imagine one price already includes VAT while another quote is shown before tax. If you compare them directly, the conclusion can be wrong because the starting points are not actually the same.',
                    'Using the tax calculator to convert both prices into the same frame, either net or gross, gives you a much more reliable comparison. That is often the difference between a guess and a usable number.',
                ],
                [
                    'Decide whether you want to compare pre-tax values or final payable totals.',
                    'Use inclusive mode when the starting number already contains VAT.',
                    'Use exclusive mode when you are starting from a net amount and need the final total.',
                    'Compare all prices in the same frame before making the final judgment.',
                ],
                [
                    'Applying the tax rate directly to a gross amount and overstating the tax portion.',
                    'Mixing inclusive and exclusive amounts in one comparison.',
                    'Forgetting that invoices and consumer prices may be presented differently.',
                    'Assuming the same label means the same pricing structure across every quote.',
                ],
                [
                    'Once the tax mode is clear, the rest of the decision becomes much easier. You can then judge value, margin, or affordability without the confusion created by inconsistent pricing frames.',
                    'That is why a simple VAT or GST calculator can be more useful than it first appears. It helps make price comparisons trustworthy again.',
                ],
                [
                    ['question' => 'Why can inclusive pricing be confusing?', 'answer' => 'Because the final amount already contains tax, so the tax portion has to be extracted rather than simply added on top.'],
                    ['question' => 'Should businesses and consumers think about this differently?', 'answer' => 'Sometimes yes, especially if one side cares more about net values while the other mainly cares about final payable totals.'],
                    ['question' => 'What is the safest way to compare prices?', 'answer' => 'Convert them into the same format first, either net or gross, and only then compare the numbers.'],
                ]
            ),
            default => self::build(
                'Who this guide helps',
                ['This guide helps readers turn a finance question into a more practical decision by combining explanation, examples, and next-step thinking.'],
                'Worked example',
                ['A simple worked scenario can make the core idea easier to understand before you test your own numbers.'],
                ['Start with the baseline inputs.', 'Compare at least one alternative scenario.', 'Review the tradeoff in plain language.', 'Use the result to guide the next decision.'],
                ['Relying on one number alone.', 'Ignoring tradeoffs behind the output.', 'Skipping scenario comparisons.'],
                ['The more clearly you can compare realistic options, the more useful the guide becomes.'],
                []
            ),
        };
    }

    protected static function build(
        string $audienceHeading,
        array $audienceParagraphs,
        string $exampleHeading,
        array $exampleParagraphs,
        array $steps,
        array $mistakes,
        array $closingParagraphs,
        array $extraFaqs
    ): array {
        return [
            'author' => [
                'label' => 'Reviewed for FinguruTools',
                'name' => 'Finance content team',
                'note' => 'This article is reviewed by the FinguruTools finance content team, a small group of researchers, writers, and product builders focused on practical personal-finance education.',
                'bio' => [
                    'Our role is to turn common finance questions into plain-language planning guidance that works alongside calculators, examples, and scenario comparisons.',
                    'We write for general educational use and update pages when users need clearer assumptions, better examples, or stronger context before making a real-world decision.',
                ],
            ],
            'review_process' => [
                'heading' => 'How we approach this topic',
                'paragraphs' => [
                    'Each FinguruTools guide is designed to support a real calculator or finance planning workflow. That means the article is not meant to be filler around a tool. It should help a reader understand the decision, the tradeoffs, and the next question to ask before acting on a result.',
                    'We aim to keep the language practical, avoid hype, and make assumptions visible. When a topic can vary by country, lender, employer, market, or tax system, we present the page as planning guidance rather than pretending it is a one-size-fits-all official answer.',
                    'The most useful way to read a guide on FinguruTools is to pair it with a calculator, test more than one scenario, and then verify important decisions with official sources or qualified professionals where needed.',
                ],
            ],
            'audience' => [
                'heading' => $audienceHeading,
                'paragraphs' => $audienceParagraphs,
            ],
            'example' => [
                'heading' => $exampleHeading,
                'paragraphs' => $exampleParagraphs,
                'steps' => $steps,
            ],
            'mistakes' => [
                'heading' => 'Common mistakes to avoid',
                'items' => $mistakes,
            ],
            'checklist' => [
                'heading' => 'Before you act on the result',
                'items' => [
                    'Check whether the inputs reflect your real current numbers rather than ideal or outdated assumptions.',
                    'Compare at least one more scenario so you can see the tradeoff between the convenient option and the more conservative option.',
                    'Review how the decision affects monthly cash flow, reserves, and flexibility instead of focusing on a single attractive output.',
                    'Use the result as a planning step, then confirm important decisions with lender terms, employer documents, provider rules, tax guidance, or professional advice where relevant.',
                ],
            ],
            'closing' => [
                'heading' => 'What to do next',
                'paragraphs' => $closingParagraphs,
            ],
            'extra_faqs' => $extraFaqs,
        ];
    }
}
