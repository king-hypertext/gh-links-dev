<div>
    <!-- Be present above all else. - Naval Ravikant -->
</div>
<div class="modal fade" id="logout" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow">
            {{-- <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-5">Logout?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body p-4 pb-0 text-center">
                <h6 class="h6 fw-bold fs-5">GH LINKS</h6>
                <h5 class="mb-0">Logout of the system?</h5>
                {{-- <p class="mb-0">You can always login back to your account.</p> --}}
            </div>
            <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                <button
                    onclick="window.open('{{ auth('candidate')->check() ? route('candidate.logout') : route('employer.logout') }}', '_self')"
                    type="button" class="btn btn-lg btn-primary">Yes, Log me out</button>
                <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">No, Not Now</button>
            </div>
        </div>
    </div>
</div>
