<?php

return [
    'brand' => [
        'name' => 'FinguruTools',
        'tagline' => 'Premium worldwide finance tools and calculators by TJVerse Group.',
        'description' => 'FinguruTools publishes premium worldwide finance calculators, financial planning tools, and SEO-first educational pages for loans, investing, tax, salary, debt, and budgeting decisions.',
        'support_email' => env('SUPPORT_EMAIL', 'tjvers.group@gmail.com'),
        'website' => env('APP_URL', 'https://fingurutools.com'),
        'company' => 'TJVerse Group',
    ],
    'categories' => [
        'loan-calculators' => [
            'slug' => 'loan-calculators',
            'name' => 'Loan calculators',
            'headline' => 'Borrowing tools for mortgages, home loans, personal loans, and more.',
            'description' => 'Compare monthly payments, total interest, and borrowing scenarios for mortgages, auto loans, and personal finance decisions.',
        ],
        'investment-calculators' => [
            'slug' => 'investment-calculators',
            'name' => 'Investment calculators',
            'headline' => 'Projection tools for investing, compounding, deposits, and retirement planning.',
            'description' => 'Model recurring investing, compound growth, retirement savings, and deposit products with polished global-friendly calculators.',
        ],
        'tax-calculators' => [
            'slug' => 'tax-calculators',
            'name' => 'Tax calculators',
            'headline' => 'Tax estimate tools for broad international use.',
            'description' => 'Estimate taxes, indirect tax amounts, and take-home values with flexible inputs that can be tailored later by country or region.',
        ],
        'salary-calculators' => [
            'slug' => 'salary-calculators',
            'name' => 'Salary calculators',
            'headline' => 'Work income tools for salary, wages, and take-home pay.',
            'description' => 'Convert income across hourly, monthly, and annual views while understanding deductions and net pay scenarios.',
        ],
        'credit-calculators' => [
            'slug' => 'credit-calculators',
            'name' => 'Credit calculators',
            'headline' => 'Debt, credit card, and eligibility calculators for smarter repayment.',
            'description' => 'Understand payoff timelines, interest costs, and borrowing capacity using transparent assumptions and clear outputs.',
        ],
        'budget-calculators' => [
            'slug' => 'budget-calculators',
            'name' => 'Budget calculators',
            'headline' => 'Everyday money tools for budgeting, expenses, and currency planning.',
            'description' => 'Track spending, compare categories, and model simple currency conversion workflows in a clean planning environment.',
        ],
    ],
    'static_pages' => [
        'about' => [
            'title' => 'About FinguruTools',
            'description' => 'Learn about FinguruTools, our worldwide finance tools mission, and how this calculator platform is built for trust, clarity, and long-term SEO growth by TJVerse Group.',
            'headline' => 'A worldwide finance tools platform built by TJVerse Group under the FinguruTools brand.',
            'body' => [
                'FinguruTools is a premium finance publishing platform for people who need reliable estimates, practical financial planning tools, and clean educational content. The goal is to combine trustworthy calculator experiences with strong on-page SEO and polished product design.',
                'Our finance tools cover global borrowing, investing, taxes, salary estimation, debt payoff, budgeting, and related personal finance topics. Each page is designed to be lightweight, mobile-first, semantically structured, and easy to extend as the platform grows.',
                'This project is intentionally built on maintainable Laravel architecture so TJVerse Group can scale FinguruTools into a much broader finance ecosystem with regional calculators, educational hubs, and editorial content.',
                'We believe financial tools should not feel cluttered, outdated, or built only for search engines. Instead, they should feel reliable, simple to understand, and genuinely useful when a person needs a quick estimate before making an important decision.',
                'That is why our platform combines calculation logic, explanatory content, FAQ sections, internal linking, and structured metadata. The result is a product that can serve users directly while also building strong long-term search visibility.',
                'As TJVerse Group expands FinguruTools, we intend to add more countries, more localized finance models, more languages, deeper educational guides, and a broader library of professional-grade personal finance utilities.',
            ],
        ],
        'contact' => [
            'title' => 'Contact FinguruTools',
            'description' => 'Contact FinguruTools for calculator feedback, support, finance content requests, partnerships, or platform enquiries.',
            'headline' => 'Contact the FinguruTools team.',
            'body' => [
                'Use this page to contact FinguruTools about calculator suggestions, product support, partnerships, finance content opportunities, and feature requests.',
                'Messages submitted here are stored in the platform database and sent through Laravel mail handling so the workflow can grow into a fuller support operation later.',
                'If you notice a calculation issue, want a new country-specific calculator, or would like to discuss a partnership related to financial education, this is the right place to reach out.',
                'We review submissions to improve the accuracy, usability, and long-term value of the platform. Clear suggestions from real users help shape future calculators, local finance models, and new educational content.',
                'For the best response, include the calculator name, your country or region, the type of issue or request, and any assumptions you want us to consider.',
            ],
        ],
        'privacy-policy' => [
            'title' => 'Privacy Policy',
            'description' => 'Review the FinguruTools privacy policy covering calculator usage, contact submissions, technical data, analytics, cookies, and platform operations.',
            'headline' => 'How FinguruTools handles privacy, submissions, and site usage data.',
            'body' => [
                'FinguruTools may collect basic information needed to operate this platform, including technical usage data, contact form submissions, browser metadata, and cookies that support functionality, performance, analytics, and advertising integrations.',
                'If you contact us, we may store your name, email address, message content, IP address, and user agent so we can respond, improve the service, and keep an internal record of enquiries.',
                'We do not promise that every calculator or financial estimate is personalized advice. The platform is designed to provide general educational estimates and product-quality finance tools rather than regulated advisory services.',
                'As the platform grows, FinguruTools may integrate analytics, email delivery tools, and monetization services. This page should be reviewed periodically so it remains accurate for the live production stack.',
                'Cookies and similar technologies may be used to remember site preferences such as region selection, improve navigation, monitor aggregate usage patterns, and support platform security. Advertising or analytics tools may introduce additional privacy considerations as the live stack evolves.',
                'FinguruTools aims to minimize unnecessary data collection and to use the information it does collect in a practical, platform-related way. We may retain limited records needed for support, abuse prevention, internal analytics, operational troubleshooting, and service improvement.',
                'Users should understand that this website may be accessed internationally. Depending on where you live, local privacy laws may grant you certain rights regarding personal data access, correction, deletion, or limitation of use. If you have a privacy-related concern, you may contact us through the platform contact page.',
            ],
        ],
        'terms-and-conditions' => [
            'title' => 'Terms and Conditions',
            'description' => 'Read the full terms and conditions for using FinguruTools finance calculators, educational pages, contact forms, and related platform features.',
            'headline' => 'Terms for using FinguruTools calculators, guides, and related pages.',
            'body' => [
                'By using this website, you agree that FinguruTools provides calculator outputs, guides, and informational content on an educational basis only. Results may rely on assumptions, simplified rules, and generalized financial models.',
                'You should not treat any figure on this platform as professional financial, tax, accounting, legal, investment, lending, or regulatory advice. Always verify important decisions with qualified professionals and official sources relevant to your jurisdiction.',
                'FinguruTools may update, expand, suspend, or remove tools, pages, and features at any time. We also reserve the right to improve the assumptions, formulas, and interface structure as the platform evolves.',
                'All content, branding, layout, and software elements on this site remain the intellectual property of TJVerse Group unless otherwise stated.',
                'Users are responsible for how they interpret and apply the content on this website. Any financial action, loan decision, investment plan, tax estimate, budgeting choice, or employment-related calculation should be reviewed in the context of current laws, market conditions, institutional policies, and local professional advice.',
                'You agree not to misuse the platform, attempt unauthorized access, interfere with service availability, scrape the site in a harmful way, submit abusive material through contact forms, or use the site for unlawful or misleading purposes.',
                'FinguruTools may revise these terms at any time as the website expands into new countries, calculator categories, languages, and monetization models. Continued use of the platform after changes are published indicates acceptance of the updated terms.',
                'Where legally permitted, FinguruTools and TJVerse Group disclaim warranties related to uninterrupted availability, perfect accuracy, fitness for a particular purpose, and universal compatibility with every user scenario or jurisdiction.',
            ],
        ],
        'disclaimer' => [
            'title' => 'Disclaimer',
            'description' => 'Read the FinguruTools disclaimer covering calculator estimates, financial content limitations, international usage, and professional-advice exclusions.',
            'headline' => 'Important disclaimer for calculators, guides, and financial estimates.',
            'body' => [
                'All calculators and finance pages on this platform are provided for educational and informational purposes only. Results are estimates and may not reflect lender-specific rules, tax authority guidance, payroll systems, fees, changing market rates, or local regulations.',
                'FinguruTools does not guarantee suitability, completeness, or legal compliance for every jurisdiction. Users should verify any important number with official documentation and qualified advisers before making borrowing, investing, tax, or employment decisions.',
                'This website may contain broad international finance content, including pages relevant to the United States, Europe, and other regions. Those pages are intended to improve understanding, not replace professional advice or official compliance materials.',
                'Even when a page uses a country-aware model, users should not assume the logic reflects every regional exception, local tax law update, banking fee schedule, or lending policy. Many finance topics differ meaningfully across countries and even within sub-regions.',
                'Currency formatting, country defaults, and localized assumptions are intended to improve usability and search relevance. They do not guarantee that a calculator result matches the exact output of a bank, employer, tax authority, accounting system, or government website.',
                'By using this platform, you acknowledge that finance decisions involve real-world complexity and that this website is one planning aid among many, not the final authority on your personal or business financial situation.',
            ],
        ],
    ],
    'regional_pages' => [
        'india-finance-tools' => [
            'slug' => 'india-finance-tools',
            'title' => 'India Finance Tools',
            'meta_title' => 'India Finance Calculators, EMI Tools & Salary Estimators | FinguruTools',
            'meta_description' => 'Explore India-focused finance calculators from FinguruTools for EMI, home loans, SIP, salary, tax, GST, budgeting, and long-term planning.',
            'headline' => 'India finance calculators and money planning tools',
            'intro' => 'This hub is designed for India-focused finance searches, bringing together calculators for EMI planning, SIP growth, GST estimates, salary planning, and day-to-day money decisions in one clean place.',
            'body' => [
                'FinguruTools is building this India finance section for users who want clearer financial planning tools without the clutter commonly found on low-quality calculator sites. It is especially well suited to searches around EMI, home loans, car loans, SIP, FD, RD, salary estimation, tax planning, and GST-related calculations.',
                'As the platform grows, this India hub can expand into more country-specific finance content for income tax regimes, loan comparison pages, salary breakdown tools, business finance explainers, savings strategies, and multilingual educational content tailored to Indian users and search intent.',
            ],
            'use_cases' => [
                'Compare EMI scenarios before applying for a home loan, car loan, or personal loan.',
                'Estimate SIP, FD, and RD growth for medium-term and long-term planning.',
                'Understand GST, salary, and take-home outcomes for household or business planning.',
            ],
            'popular_searches' => [
                'emi calculator india',
                'sip calculator india',
                'gst calculator online',
                'take home salary calculator india',
            ],
            'faqs' => [
                [
                    'question' => 'Are these India finance tools only for salaried users?',
                    'answer' => 'No. The India hub is useful for salaried professionals, business owners, borrowers, savers, and anyone comparing routine personal finance decisions.',
                ],
                [
                    'question' => 'Can this section grow into more India-specific finance content later?',
                    'answer' => 'Yes. The platform is structured to expand into richer India-focused calculators, tax explainers, and local finance guides over time.',
                ],
            ],
            'related_categories' => ['loan-calculators', 'investment-calculators', 'tax-calculators', 'salary-calculators'],
            'featured_calculators' => ['emi-calculator', 'sip-calculator', 'gst-calculator', 'take-home-salary-calculator'],
        ],
        'uk-finance-tools' => [
            'slug' => 'uk-finance-tools',
            'title' => 'UK Finance Tools',
            'meta_title' => 'UK Finance Calculators, Salary Tools & Mortgage Estimators | FinguruTools',
            'meta_description' => 'Browse UK-focused finance tools from FinguruTools for mortgages, salary, tax, savings, debt payoff, and practical money planning.',
            'headline' => 'UK finance calculators and planning pages',
            'intro' => 'This regional page supports finance searches relevant to the United Kingdom, including mortgages, take-home salary, tax estimation, savings planning, debt payoff, and broader personal finance decisions.',
            'body' => [
                'The FinguruTools platform is well positioned to grow into a useful UK finance resource with calculators and guides built for searchers who compare mortgage costs, estimate pay after deductions, plan household budgets, and explore savings or debt repayment options.',
                'Over time, this UK finance hub can branch into more detailed content covering local payroll assumptions, mortgage comparison journeys, savings strategies, tax-specific explainers, and stronger internal clusters around practical UK money topics.',
            ],
            'use_cases' => [
                'Review mortgage affordability and repayment scenarios before speaking with lenders.',
                'Estimate salary, deductions, and take-home figures for planning monthly budgets.',
                'Compare savings and debt payoff choices with a cleaner decision-making workflow.',
            ],
            'popular_searches' => [
                'uk mortgage calculator',
                'salary calculator uk',
                'take home pay calculator uk',
                'budget planner uk',
            ],
            'faqs' => [
                [
                    'question' => 'Does this UK hub replace official tax or payroll tools?',
                    'answer' => 'No. It is designed for planning and education, not as a replacement for official payroll systems, tax authority resources, or regulated advice.',
                ],
                [
                    'question' => 'Why build separate UK finance pages?',
                    'answer' => 'UK users often search with country-specific finance terms, so a dedicated hub improves relevance, internal linking, and future localization.',
                ],
            ],
            'related_categories' => ['loan-calculators', 'salary-calculators', 'tax-calculators', 'budget-calculators'],
            'featured_calculators' => ['mortgage-calculator', 'salary-calculator', 'take-home-salary-calculator', 'debt-payoff-calculator'],
        ],
        'us-finance-tools' => [
            'slug' => 'us-finance-tools',
            'title' => 'US Finance Tools',
            'meta_title' => 'US Finance Calculators, Tax Tools & Salary Estimators | FinguruTools',
            'meta_description' => 'Explore SEO-friendly U.S. finance calculators from FinguruTools for loans, mortgages, taxes, salary, debt payoff, and financial planning.',
            'headline' => 'US finance calculators and planning tools',
            'intro' => 'This regional landing page is built for people searching for finance calculators relevant to the United States. It provides a clean hub for U.S.-oriented mortgage, loan, take-home pay, income tax, and debt planning tools.',
            'body' => [
                'The FinguruTools platform is designed to scale into a strong U.S. personal finance resource with calculators, guides, and educational pages that reflect how American users compare loans, estimate federal tax, model take-home pay, and understand debt repayment.',
                'Today, the platform already includes U.S.-friendly logic in selected tax and salary tools, along with calculators for mortgage planning, car loans, personal loans, and credit card payoff. Over time, this section can grow into a broader U.S. finance content cluster with state-level tax logic, APR explainers, refinancing content, and more.',
            ],
            'use_cases' => [
                'Estimate mortgage, personal loan, and credit repayment scenarios with clearer monthly cost views.',
                'Review salary, tax, and take-home planning before making work or relocation decisions.',
                'Use a structured U.S. finance hub to compare borrowing, budgeting, and debt payoff options.',
            ],
            'popular_searches' => [
                'mortgage calculator usa',
                'income tax calculator us',
                'take home pay calculator usa',
                'credit card payoff calculator',
            ],
            'faqs' => [
                [
                    'question' => 'Who should use the U.S. finance tools page?',
                    'answer' => 'It is useful for borrowers, employees, households, and planners who want a cleaner way to compare U.S.-oriented loan, salary, tax, and debt scenarios.',
                ],
                [
                    'question' => 'Will this U.S. section become more detailed later?',
                    'answer' => 'Yes. It is designed to grow into deeper U.S. finance coverage with richer tax, mortgage, and comparison content.',
                ],
            ],
            'related_categories' => ['loan-calculators', 'tax-calculators', 'salary-calculators', 'credit-calculators'],
            'featured_calculators' => ['mortgage-calculator', 'income-tax-calculator', 'take-home-salary-calculator', 'credit-card-interest-calculator'],
        ],
        'eu-finance-tools' => [
            'slug' => 'eu-finance-tools',
            'title' => 'EU Finance Tools',
            'meta_title' => 'EU Finance Calculators, VAT Tools & Budget Planners | FinguruTools',
            'meta_description' => 'Browse EU-focused finance tools from FinguruTools including VAT, salary, savings, mortgage, and budgeting calculators with strong SEO structure.',
            'headline' => 'EU finance calculators and money planning pages',
            'intro' => 'This landing page supports finance-related searches across Europe with a clean internal hub for VAT, salary, budgeting, mortgage, savings, and broader financial planning tools.',
            'body' => [
                'FinguruTools is preparing this section to support European finance search intent with lightweight calculators and trustworthy explanatory content. The current foundation already includes VAT-ready tools, salary estimation, budgeting flows, savings projections, and borrowing calculators that can later be localized by market.',
                'As the platform expands, this EU hub can branch into regional finance content for VAT treatment, payroll structures, savings products, mortgage assumptions, and country-specific consumer finance rules across multiple European markets.',
            ],
            'use_cases' => [
                'Use VAT, salary, and savings tools in a cleaner cross-market planning environment.',
                'Start with a broad Europe-focused hub before branching into country-specific finance pages later.',
                'Compare budgeting, borrowing, and long-term savings scenarios with less friction.',
            ],
            'popular_searches' => [
                'vat calculator europe',
                'salary calculator europe',
                'budget planner europe',
                'savings calculator eu',
            ],
            'faqs' => [
                [
                    'question' => 'Why use a broad EU finance hub instead of only country pages?',
                    'answer' => 'An EU hub helps capture broad European search intent and provides a strong internal linking foundation before expanding into more localized country finance pages.',
                ],
                [
                    'question' => 'Can this page support more localized EU markets later?',
                    'answer' => 'Yes. The structure is designed to grow into country-specific finance clusters for markets such as Germany, France, Spain, Italy, and others.',
                ],
            ],
            'related_categories' => ['tax-calculators', 'salary-calculators', 'investment-calculators', 'budget-calculators'],
            'featured_calculators' => ['vat-calculator', 'salary-calculator', 'savings-calculator', 'budget-calculator'],
        ],
    ],
];
