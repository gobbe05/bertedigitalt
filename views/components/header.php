<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<header class="d-flex bg-secondary p-4">
    <h3 class="text-white">Admin - Bertemuseum Digitalt</h3>
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Sign Out?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure that you want to sign out?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <a class="d-flex align-items-center gap-1 btn btn-danger" href="/admin/logout">Sign Out <span class="material-symbols-outlined">logout</span></a>
            </div>
          </div>
        </div>
    </div>
    <button class="d-flex align-items-center gap-1 btn btn-danger ms-auto" type="button" data-bs-toggle="modal" data-bs-target="#modal">Sign Out <span class="material-symbols-outlined">logout</span></button>
</header>