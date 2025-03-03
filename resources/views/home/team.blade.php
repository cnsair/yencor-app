<div class="div-padding team-div">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <h2 class="div-title text-center">The team behind Yencor</h2>
            </div>
        </div>
        <div class="row">
            @forelse ($team_data as $team)

                <div class="col-lg-3 col-sm-6">
                    <div class="single-team-member">
                        <div class="member-img">
                            @php
                                $file = $team->profile_photo_path;
                                $photo_path  = $file ? asset('storage/' . $file) : "assets/assets/images/avatar.png";
                            @endphp

                            <img style="width: 100%; height: 18rem; object-fit: cover;" class="me-3" src="{{ $photo_path }}" alt="partner-img" alt="ProfilePicture">
                        </div>
                        <div class="member-info">
                            <h4 class="member-name mb-1">{{ $team->firstname ." ". $team->lastname ?? "N/A" }}</h4>
                            <p class="theme-color mb-2">{{ $team->admin_role ?? "N/A" }}</p>
                            <p class="mb-0">{{ Str::limit($team->biography, 100)  ?? "N/A" }}</p>
                        </div>
                    </div>
                </div>
                
            @empty
                <p>Ooops.. Nothing here now!</p>
            @endforelse
           
        </div>
    </div>
</div>