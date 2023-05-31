<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            {{-- <img src="{{ asset('theme') }}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon"> --}}
        </div>
        <div>
            <h4 class="logo-text">Rocker</h4>
        </div>
        {{-- <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div> --}}
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="parent-icon">
                    <i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li>
            <a href="{{ url('/stream') }}">
                <div class="parent-icon">
                    <i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Stream</div>
            </a>
        </li>

        <li>
            <a href="{{ url('/cameras') }}">
                <div class="parent-icon">
                    <i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Cameras</div>
            </a>
        </li>

        <form action="{{ url('/logout') }}" method="post">
            <li id="logout">
                @csrf
                <a>
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Logout</div>
                </a>
            </li>
        </form>


    </ul>
    <!--end navigation-->
</div>

@push('js')
    <script>
        var logout = document.getElementById('logout');
        logout.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('form').submit();
        });
    </script>
@endpush
