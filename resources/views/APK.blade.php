@extends('layout.main')
@section('content')
    <div class="container-fluid py-4">
        <!-- Page Title -->
        <div class="row mb-4 align-items-center">
            <div class="col">
                <h2 class="fw-bold mb-0">Rilis Manager</h2>

            </div>
            <div class="col-auto">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="mdi mdi-plus"></i> New Release
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('APK.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="fileInput" class="form-label">Choose File</label>
                                <input class="form-control" type="file" id="fileInput" name="APK" required>
                            </div>
                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Description</label>
                                <textarea class="form-control" id="descriptionInput" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="versionInput" class="form-label">Version</label>
                                <input class="form-control" type="text" id="versionInput" name="version">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Storage Info -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <span class="badge bg-secondary mb-2">FREE SPACE</span>
                        <h6 class="text-uppercase">
                            <i class="mdi mdi-harddisk text-success me-1"></i> Storage
                        </h6>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ $freeSpacePercentage }}%" aria-valuenow="{{ $freeSpacePercentage }}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted">{{ $freeSpace }} free of {{ $totalSpace }}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">TOTAL DOWNLOAD</span>
                        <h6 class="text-uppercase">
                            <i class="mdi mdi-download text-success me-1"></i> Total Downloads
                        </h6>
                        <div class="d-flex align-items-center mb-2">
                            <i class="mdi mdi-download text-success me-2"></i>
                            <span class="fs-5 fw-bold">{{ $downloaded }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">TOTAL UPLOAD</span>
                        <h6 class="text-uppercase">
                            <i class="mdi mdi-upload text-primary me-1"></i> Total Uploads
                        </h6>
                        <div class="d-flex align-items-center mb-2">
                            <i class="mdi mdi-upload text-primary me-2"></i>
                            <span class="fs-5 fw-bold">{{ $uploaded }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Release List -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="mb-3 fw-semibold">Release List</h5>
                        <div class="table-responsive">
                            <table class="table align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Last Modified</th>
                                        <th>Size</th>
                                        <th>Description</th>
                                        <th>Version</th>
                                        <th>Download</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($apk as $release)
                                        <tr>
                                            <td>
                                                <a href="#"
                                                    class="fw-semibold text-decoration-none">{{ $release->name }}</a>
                                            </td>
                                            <td>
                                                <div>{{ $release->created_at->format('d M Y') }}</div>
                                            </td>
                                            <td>
                                                {{ $release->size ? number_format($release->size / 1024, 2) . ' MB' : 'N/A' }}
                                            </td>
                                            <td>{{ $release->description }}</td>
                                            <td>
                                                <span class="badge bg-info">V {{ $release->version }}</span>
                                            </td>
                                            <td>{{ $release->download }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <!-- Share Button -->
                                                    <button class="btn btn-sm btn-outline-primary" title="Share"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#shareModal-{{ $release->id }}">
                                                        <i class="mdi mdi-share-variant"></i>
                                                    </button>
                                                    <!-- Get Link Button -->
                                                    <button class="btn btn-sm btn-outline-secondary" title="Get Link"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#linkModal-{{ $release->id }}">
                                                        <i class="mdi mdi-link"></i>
                                                    </button>
                                                    <!-- Rename Button -->
                                                    <button class="btn btn-sm btn-outline-warning" title="Rename"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#renameModal-{{ $release->id }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <!-- Download Button -->
                                                    <a href="{{ route('downloadAPK', $release->id) }}"
                                                        class="btn btn-sm btn-outline-success" title="Download">
                                                        <i class="mdi mdi-download"></i>
                                                    </a>
                                                    <!-- Remove Button -->
                                                    <button class="btn btn-sm btn-outline-danger" title="Remove"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-{{ $release->id }}">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>

                                                <!-- Share Modal -->
                                                <div class="modal fade" id="shareModal-{{ $release->id }}"
                                                    tabindex="-1" aria-labelledby="shareModalLabel-{{ $release->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="shareModalLabel-{{ $release->id }}">Share Release
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                        id="share-link-{{ $release->id }}"
                                                                        value="{{ route('downloadAPK', $release->id) }}"
                                                                        readonly>
                                                                    <button class="btn btn-outline-secondary"
                                                                        type="button"
                                                                        onclick="navigator.clipboard.writeText(document.getElementById('share-link-{{ $release->id }}').value).then(function() { Swal.fire({icon: 'success', title: 'Copied!', text: 'Link copied to clipboard', timer: 1200, showConfirmButton: false}); });">
                                                                        Copy
                                                                    </button>
                                                                </div>
                                                                <small class="text-muted">Copy and share this link.</small>
                                                                <div class="d-flex justify-content-center">
                                                                    <iframe
                                                                        src="{{ route('generateQRCode', [$release->id, 300]) }}"
                                                                        frameborder="0"
                                                                        style="aspect-ratio: 1 / 1; display: block;"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Get Link Modal -->
                                                <div class="modal fade" id="linkModal-{{ $release->id }}"
                                                    tabindex="-1" aria-labelledby="linkModalLabel-{{ $release->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="linkModalLabel-{{ $release->id }}">Get Download
                                                                    Link</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                        id="share-link-{{ $release->id }}"
                                                                        value="{{ route('downloadAPK', $release->id) }}"
                                                                        readonly>
                                                                    <button class="btn btn-outline-secondary"
                                                                        type="button"
                                                                        onclick="navigator.clipboard.writeText(document.getElementById('share-link-{{ $release->id }}').value).then(function() { Swal.fire({icon: 'success', title: 'Copied!', text: 'Link copied to clipboard', timer: 1200, showConfirmButton: false}); });">
                                                                        Copy
                                                                    </button>
                                                                </div>
                                                                <small class="text-muted">Use this link to download the
                                                                    file directly.</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Rename Modal -->
                                                <div class="modal fade" id="renameModal-{{ $release->id }}"
                                                    tabindex="-1" aria-labelledby="renameModalLabel-{{ $release->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="POST"
                                                                action="{{ route('APK.update', $release->id) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="renameModalLabel-{{ $release->id }}">Edit
                                                                        Release</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="editName-{{ $release->id }}"
                                                                            class="form-label">Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="editName-{{ $release->id }}"
                                                                            name="name" value="{{ $release->name }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editDescription-{{ $release->id }}"
                                                                            class="form-label">Description</label>
                                                                        <textarea class="form-control" id="editDescription-{{ $release->id }}" name="description" rows="3">{{ $release->description }}</textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="editVersion-{{ $release->id }}"
                                                                            class="form-label">Version</label>
                                                                        <input type="text" class="form-control"
                                                                            id="editVersion-{{ $release->id }}"
                                                                            name="version"
                                                                            value="{{ $release->version }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-warning">Save
                                                                        Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal-{{ $release->id }}"
                                                    tabindex="-1" aria-labelledby="deleteModalLabel-{{ $release->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="POST"
                                                                action="{{ route('APK.destroy', $release->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="deleteModalLabel-{{ $release->id }}">Delete
                                                                        Release</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete
                                                                    <strong>{{ $release->name }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No releases found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
