@extends('layouts.app-home')

@section('content')

    <div class="breadcrumb-div">
        <div class="container">
            <h1 class="page-title mb-0">About Us</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>About</li>
            </ol>
        </div>
    </div>

    <section class="who-we-are div-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="who-we-are-left-content">
                        <h2 class="who-we-are-title pb-4">About Us</h2>
                        <p class="justified-text">
                            YENCOR is an AI-powered smart public transportation app developed by AFRICA BLOCKCHAIN CONSORTIUM & DIGITAL ECONOMY LIMITED in collaboration with students from the Ghana Communication Technology University, Accra - Ghana. Just like popular ride-hailing apps, but tailored for public buses, YENCOR makes traveling easier by helping you find buses going your way — with a few extra features to improve your journey. <br/>

                            Unlike traditional ride-hailing apps, YENCOR is built specifically for public buses, offering real-time tracking, intelligent route planning, and cashless payments—all powered by AI to improve efficiency and enhance your travel experience.
                        </p>
                        
                        <p class="justified-text">
                            How AI enhances your YENCOR experience:
                        </p>
                        <ul class="visible-bullet-points">
                            <li>✅ Locate Available Buses: See nearby buses registered on the app and traveling towards your destination.</li>
                            <li>✅ Pin Your Location: Indicate where you’re waiting, so drivers know you’re at the bus-stop.</li>
                            <li>✅ Hop On and Go: Once you board and the bus moves from your location, your pin automatically sets your destination.</li>
                            <li>✅ Pay Easily: No need to carry cash — just scan the bus’ QR code to pay instantly.</li>
                            <li>✅ Personalized Travel Insights: App learns your commuting patterns and provides tailored recommendations.
                            </li>
                        </ul>

                        <p class="justified-text">
                            Whether you’re commuting to work, school, or running errands, YENCOR simplifies your journey by bridging the gap between passengers and drivers. YENCOR helps you plan better, avoid the guesswork and long waits at the bus stop. We are here to make public transportation more reliable, predictable, and stress-free.  <br>
                            Wherever you’re headed, YENCOR connects you to the right bus, fast and hassle-free. <br>
                           <p>
                             <b> YENCOR – Let's Go!  </b>
                           </p>
                        </p>
                    </div>
                </div>
                
                <div class="col-12 col-lg-6">
                    <div class="who-we-are-right-content">
                        <img class="who-we-are-blob" src="assets/assets/images/home/yellow-blob.svg" alt="Yellow blob">
                        <img class="who-we-are-image-1" width="500" src="assets/assets/images/home/conference-meeting-1.png" alt="Group of people">
                        <img class="who-we-are-image-2" width="300" src="assets/assets/images/home/office-1.webp" alt="Group of people">
                        <img class="who-we-are-blob-2" src="assets/assets/images/home/yellow-blob.svg" alt="Yellow blob">
                    </div>
                </div>
            </div>

            <!-- Dropdown Button Section -->
            <div class="dropdown-container">
                <div class="dropdown-box">
                    <span class="dropdown-text"><b> See our Mission and Vision statement </b></span>
                    <svg id="dropdownIcon" class="dropdown-icon" viewBox="0 0 24 24" title="Toggle dropdown">
                        <path fill="black" d="M10.9394 15.5607C11.5252 16.1464 12.4749 16.1464 13.0607 15.5607L17.0607 11.5607C17.6465 10.9749 17.6465 10.0251 17.0607 9.43934C16.4749 8.85355 15.5252 8.85355 14.9394 9.43934L12 12.3787L9.06069 9.43934C8.4749 8.85355 7.52515 8.85355 6.93937 9.43934C6.35358 10.0251 6.35358 10.9749 6.93937 11.5607L10.9394 15.5607Z"></path>
                    </svg>
                </div>
                <div id="dropdownContent" class="dropdown-content" style="display: none;">
                    <div class="dropdown-text-box">
                        <p class="dropdown-text-content">
                        <h2>  Mission  </h2>
                        At YENCOR, our mission is to make public transportation more accessible, efficient, and stress-free. We aim to connect riders and bus drivers seamlessly, helping people find buses traveling to their destination, board with ease, and pay digitally. With YENCOR, public transport becomes simpler and more reliable for everyone.
                        </p>
                        <p class="dropdown-text-content2">
                            
                       <h2> Vision </h2>
                        Our vision is to revolutionize public transportation by providing a smarter way for people to travel.
                        We aspire to create a world where waiting at bus stops becomes a thing of the past, every ride is convenient, and public buses are just a tap away. YENCOR strives to be the leading platform that transforms the way people move, making public transit easy, predictable, and enjoyable for all.
                        </p>
                    </div>
                </div>
            </div>
            <!-- End of Dropdown Button Section -->
        </div>
    </section>

    @include('home.counter')
    @include('home.team')

    <script>
        document.querySelector('.dropdown-box').addEventListener('click', function() {
            var dropdownContent = document.getElementById('dropdownContent');
            if (dropdownContent.style.display === 'none') {
                dropdownContent.style.display = 'block'; // Show content
            } else {
                dropdownContent.style.display = 'none'; // Hide content
            }
        });
    </script>

@endsection