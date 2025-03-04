@extends('layouts.app-rider')

@section('content')

    <div class="breadcrumb-div">
        <div class="container">
            <h1 class="page-title mb-0">Let's Ride</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('rider.dashboard') }}">Home</a></li>
                <li>Ride with Yencor</li>
            </ol>
        </div>
    </div>
    
    <div class="div-padding our-vehicles-div">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="booking-form">
                        <form id="bookingForm" action="#">
                            <div class="from-group destination">
                                <label for="inputFrom">From</label>
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" name="frominputDestination" placeholder="Select Pickup"
                                    id="inputFrom" class="form-control">
                            </div>
                            <div class="from-group destination">
                                <label for="inputDestination">Where to?</label>
                                <i class="fas fa-map-marker-alt"></i>
                                <input type="text" name="desctination" placeholder="Select Destination"
                                    id="inputDestination" class="form-control">
                            </div>
                            <div class="payment-options-wrapper">
                                <h2>Payment Method</h2>
                                <div class="from-group payment-options">
                                    <div class="form-check form-check-inline" data-value="option1">
                                        <label class="form-check-label" for="cash-pay">Cash</label>
                                    </div>
                                    <div class="form-check form-check-inline" data-value="option2">
                                        <label class="form-check-label" for="banking-pay">Debit/Credit Card</label>
                                    </div>
                                    <div class="form-check form-check-inline" data-value="option3">
                                        <label class="form-check-label" for="card-pay">Crypto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="select-car-wrapper">
                                <h2>Selected Car</h2>
                                <div class="selected-car">
                                    <div class="form-group car-options">
                                        <div class="car-option" onclick="selectCar('economy')">
                                            <img src="{{ asset('assets/assets/images/home/economy.png') }}" alt="economy" class="car-image" id="economy">
                                            <div class="car-details">
                                                <p>Economy</p>
                                            </div>
                                        </div>
                                        <div class="car-option" onclick="selectCar('standard')">
                                            <img src="{{ asset('assets/assets/images/home/luxury.png') }}" alt="luxury" class="car-image" id="standard">
                                            <div class="car-details">
                                                <p>Luxury</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="button button-dark">Book Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ride-map-area">
                        <div class="mapouter">
                            <div class="gmap_canvas">

                                <livewire:maps />
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="noDriverModal" tabindex="-1" aria-labelledby="noDriverModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noDriverModalLabel">Notice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    There is no driver in your area.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("bookingForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent actual form submission
            $("#noDriverModal").modal("show"); // Show Bootstrap modal
        });

        $(document).ready(function() {
            // Manually close the modal when "Close" or "OK" is clicked
            $(".close, .btn-primary").click(function() {
                $("#noDriverModal").modal("hide");
            });
        });
    
        // document.getElementById("bookingForm").addEventListener("submit", function(event) {
        //     event.preventDefault(); // Prevent form submission
        //     alert("There is no driver in your area.");
        // });
    </script>
@endsection