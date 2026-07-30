<x-layout
    title="Payment Services Disclosure | Techibytes Media"
    description="A simple explanation of Techibytes Media payment technology and the role of Flutterwave, Stripe and other payment providers."
>
    <x-legal-page
        eyebrow="Payments"
        title="Payment Services Disclosure"
        summary="A simple explanation of what Techibytes does and how independent payment providers process transactions."
        effective-date="July 30, 2026"
        :sections="[
            ['id' => 'our-role', 'label' => 'Our role'],
            ['id' => 'providers', 'label' => 'Payment providers'],
            ['id' => 'before-paying', 'label' => 'Before paying'],
            ['id' => 'outcomes', 'label' => 'Payment outcomes'],
            ['id' => 'records', 'label' => 'Records and privacy'],
            ['id' => 'contact', 'label' => 'Questions'],
        ]"
    >
        <div class="rounded-2xl border border-accent/30 bg-accent/5 p-6 text-sm leading-7">
            <p class="font-semibold text-bone">Important</p>
            <p class="mt-2 text-muted">Techibytes Media is a software development and digital marketing company that also operates digital products. Some products include payment features, but Techibytes is not a bank. Flutterwave, Stripe and other independent providers process payments made through our technology.</p>
        </div>

        <section id="our-role" class="scroll-mt-28 space-y-4">
            <h2 class="font-display text-2xl font-bold text-bone sm:text-3xl">1. Our role</h2>
            <p>Some Techibytes products allow businesses or individuals to create invoices, send payment links, request money and accept customer payments. Techibytes provides the software and payment interface.</p>
            <p>Techibytes does not take custody of, hold, control or redistribute customer funds. The applicable payment provider or financial institution receives and handles the funds.</p>
            <p>Unless a checkout clearly says otherwise, the merchant is the seller and is responsible for the goods or services, amount, delivery, customer support and refund policy.</p>
        </section>

        <section id="providers" class="scroll-mt-28 space-y-4">
            <h2 class="font-display text-2xl font-bold text-bone sm:text-3xl">2. Payment providers</h2>
            <p>Flutterwave, Stripe and other independent payment providers process payment details, communicate with banks and card networks, and handle authorization and settlement. Their own terms and privacy notices may also apply.</p>
            <p>Any balance, transaction status or payout information displayed by a Techibytes product is informational and based on provider information. It is not a deposit held by Techibytes. Only the applicable provider or financial institution can release, redirect or complete a settlement or payout.</p>
            <p>When secure provider checkout fields are used, full card numbers and CVC security codes go directly to the provider and are not intentionally stored by Techibytes.</p>
        </section>

        <section id="before-paying" class="scroll-mt-28 space-y-4">
            <h2 class="font-display text-2xl font-bold text-bone sm:text-3xl">3. Before paying</h2>
            <p>Check the merchant, amount, currency, transaction description and refund terms before confirming a payment. Use only a payment method you are authorized to use.</p>
            <p>By clicking Pay, Continue or Confirm, you authorize the payment provider to process the transaction and any security checks required by your bank.</p>
        </section>

        <section id="outcomes" class="scroll-mt-28 space-y-4">
            <h2 class="font-display text-2xl font-bold text-bone sm:text-3xl">4. Payment outcomes and refunds</h2>
            <p>A bank or payment provider may approve, decline, delay or reverse a payment. A successful checkout message does not always mean that final settlement is complete.</p>
            <p>Your bank statement may show Techibytes, the merchant, Flutterwave, Stripe, another provider or an abbreviated description.</p>
            <p>Contact the merchant first about goods, services or refunds. For an unauthorized payment or eligible payment dispute, you may also contact your bank or payment provider.</p>
        </section>

        <section id="records" class="scroll-mt-28 space-y-4">
            <h2 class="font-display text-2xl font-bold text-bone sm:text-3xl">5. Records and privacy</h2>
            <p>We may record the transaction reference, date and time, Terms version, IP address, device information and payment result. We use this information for receipts, support, fraud review, refunds and disputes.</p>
            <p>For more information, read our <a href="{{ route('terms') }}" class="font-semibold text-accent underline decoration-accent/30 underline-offset-4">Terms and Conditions</a> and <a href="{{ route('privacy') }}" class="font-semibold text-accent underline decoration-accent/30 underline-offset-4">Privacy Policy</a>.</p>
        </section>

        <section id="contact" class="scroll-mt-28 space-y-4">
            <h2 class="font-display text-2xl font-bold text-bone sm:text-3xl">6. Questions</h2>
            <p>For a question about the Techibytes payment interface or transaction record, contact us and include the transaction reference.</p>
            <div class="rounded-2xl border border-line bg-panel p-6">
                <p class="font-semibold text-bone">Techibytes Media LLC</p>
                <p class="mt-2"><a href="mailto:support@techibytesmedia.com" class="font-semibold text-accent">support@techibytesmedia.com</a></p>
            </div>
        </section>
    </x-legal-page>
</x-layout>