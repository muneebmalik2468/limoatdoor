@extends('layouts.app') {{-- Use your layout file here --}}

@section('title', 'Privacy Policy')

@section('content')
<section class="py-8 bg-gray-50 text-gray-800 px-4">
    <div class="max-w-2xl mx-auto w-full bg-white/80 shadow-lg rounded-lg p-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-8 text-center">Privacy Policy</h1>

            <p class="mb-6">
                Limo At Door ("we", "our", or "us") is committed to protecting your personal data and respecting your privacy. This Privacy Policy explains how we collect, use, and safeguard your data in accordance with global data protection regulations including the GDPR (EU), CCPA (California), and other applicable laws.
            </p>

            <h2 class="text-2xl font-semibold mt-10 mb-4">1. Information We Collect</h2>
            <ul class="list-disc list-inside space-y-2">
                <li><strong>Personal Information:</strong> Name, email, phone number, billing address, etc.</li>
                <li><strong>Booking Information:</strong> Pickup and drop-off locations, dates, vehicle preferences.</li>
                <li><strong>Payment Details:</strong> We use secure third-party providers for payment processing (e.g., Stripe).</li>
                <li><strong>Device/Usage Data:</strong> IP address, browser type, pages visited, and usage patterns.</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-10 mb-4">2. How We Use Your Information</h2>
            <p class="mb-4">Your data is used for the following purposes:</p>
            <ul class="list-disc list-inside space-y-2">
                <li>To provide and manage your bookings.</li>
                <li>To send service-related notifications and updates.</li>
                <li>To improve our services and personalize your experience.</li>
                <li>To comply with legal obligations and prevent fraud.</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-10 mb-4">3. Legal Basis for Processing</h2>
            <p>Under GDPR, we process your data under one or more of the following legal bases:</p>
            <ul class="list-disc list-inside space-y-2">
                <li>Performance of a contract</li>
                <li>Legal obligation</li>
                <li>Consent (for optional communications)</li>
                <li>Legitimate interest</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-10 mb-4">4. Your Rights</h2>
            <p>You may have rights under data protection laws, including:</p>
            <ul class="list-disc list-inside space-y-2">
                <li>Accessing your personal data</li>
                <li>Correcting inaccurate information</li>
                <li>Requesting data deletion</li>
                <li>Objecting to or limiting data processing</li>
                <li>Withdrawing consent</li>
                <li>Filing a complaint with a regulatory authority</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-10 mb-4">5. Data Retention</h2>
            <p>
                We retain your data only as long as necessary to fulfill the purposes outlined above and to comply with legal obligations.
            </p>

            <h2 class="text-2xl font-semibold mt-10 mb-4">6. Sharing Your Information</h2>
            <p>We do not sell your data. We only share it with:</p>
            <ul class="list-disc list-inside space-y-2">
                <li>Service providers (e.g., payment processors, email services)</li>
                <li>Government or law enforcement when legally required</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-10 mb-4">7. Cookies and Tracking</h2>
            <p>
                We use cookies to enhance user experience. You can manage or disable cookies in your browser settings.
            </p>

            <h2 class="text-2xl font-semibold mt-10 mb-4">8. International Data Transfers</h2>
            <p>
                If you are accessing our services from outside the United States, your data may be transferred and processed in countries with different data protection laws. We ensure appropriate safeguards are in place.
            </p>

            <h2 class="text-2xl font-semibold mt-10 mb-4">9. Children's Privacy</h2>
            <p>
                Our services are not intended for children under 13 (or 16 in some jurisdictions). We do not knowingly collect data from minors.
            </p>

            <h2 class="text-2xl font-semibold mt-10 mb-4">10. Contact Information</h2>
            <p>
                If you have questions or concerns about this Privacy Policy or wish to exercise your rights, please contact us:
            </p>
            <ul class="mt-4">
                <!-- <li><strong>Phone:</strong> <a href="tel:+12125612600" class="text-blue-600 hover:underline">(281) 541-9224</a></li> -->
                <li><strong>Email:</strong> <a href="mailto:limoatdoor@gmail.com" class="text-blue-600 hover:underline">limoatdoor@gmail.com</a></li>
                <li><strong>Address:</strong> 3040 fm 1960 #144, Houston, TX 77073.</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-10 mb-4">11. Updates to This Policy</h2>
            <p>
                We may update this Privacy Policy from time to time. Changes will be posted on this page with an updated revision date.
            </p>

            <p class="mt-10 text-sm text-gray-500">Last Updated: September 7, 2025</p>
        </div>
    </div>
</section>
@include('layouts.footer')
@endsection
