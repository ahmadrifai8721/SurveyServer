@extends('layout.mainAndro')

@section('content')
    <div class="container d-flex align-items-center justify-content-center min-vh-100 min-vw-100"
        style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
        <div class="card shadow-lg border-0" style="max-width: 420px; width: 100%; border-radius: 1.5rem;">
            <div class="card-body text-center">
                <div class="mb-4">
                    <img src="{{ asset('assets/images/bg-auth.jpg') }}" alt="Kiss Bunda Logo" height="100px">
                </div>
                <h5 class="mb-3" style="color: #a259ec;">What's New</h5>
                <p class="text-secondary mb-4">
                    {{ $apk->description ?? 'Enjoy improved performance, bug fixes, and exciting new features in this release.' }}
                </p>
                <hr class="my-4" style="border-top: 1px solid #e0c3fc;">
                <div class="mb-3">
                    <span class="badge rounded-pill px-3 py-2" style="background: #a259ec; color: #fff; font-size: 1rem;">
                        Version: {{ $apk->version ?? 'N/A' }}
                    </span>
                    <br>
                    <br>
                    <span class="badge rounded-pill px-3 py-2" style="background: #a259ec; color: #fff; font-size: 1rem;">
                        Size: {{ $apk->size ? number_format($apk->size / 1024) . ' MB' : 'N/A' }}
                    </span>
                </div>
                @if (isset($apk) && isset($apk->id))
                    <form action="{{ route('downloadAPK.go', $apk->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-lg btn-block"
                            style="background: #a259ec; color: #fff; border-radius: 2rem; font-weight: 600;">
                            <i class="bi bi-download me-2"></i> Download APK
                        </button>
                    </form>
                @else
                    <button class="btn btn-lg btn-block"
                        style="background: #a259ec; color: #fff; border-radius: 2rem; font-weight: 600;" disabled>
                        <i class="bi bi-download me-2"></i> Download APK (Unavailable)
                    </button>
                @endif

                <p class="text-muted mt-4 mb-0" style="font-size: 0.9rem;">
                    Last updated: {{ $apk->updated_at ? $apk->updated_at->format('Y-m-d') : date('Y-m-d') }}
                </p>
            </div>
        </div>
    </div>
@endsection
