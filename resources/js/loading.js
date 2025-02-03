// resources/js/loading.js
export function initializeLoading() {
    // Check if dependencies are loaded
    if (typeof NProgress === 'undefined') {
        console.error('NProgress is not loaded');
        return;
    }
    if (typeof Swal === 'undefined') {
        console.error('SweetAlert2 is not loaded');
        return;
    }

    // Configure NProgress
    NProgress.configure({ 
        minimum: 0.1,
        showSpinner: false 
    });

    window.showLoading = function() {
        document.body.classList.add('disable-clicks');
        const overlay = document.getElementById('loading-overlay');
        if (overlay) {
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        }
        NProgress.start();
    };

    window.hideLoading = function() {
        document.body.classList.remove('disable-clicks');
        const overlay = document.getElementById('loading-overlay');
        if (overlay) {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
        }
        NProgress.done();
    };

    window.confirmDelete = function(event, deleteUrl, csrf_token) {
        event.preventDefault(); // Prevent any default action

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading();
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${csrf_token}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    };

    // Handle forms with class 'loading-form'
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.loading-form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // Prevent double submission
                if (form.classList.contains('submitting')) {
                    e.preventDefault();
                    return;
                }
                form.classList.add('submitting');
                showLoading();
            });
        });

        // Handle delete buttons
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                const deleteUrl = this.dataset.deleteUrl;
                const csrf_token = document.querySelector('meta[name="csrf-token"]').content;
                confirmDelete(event, deleteUrl, csrf_token);
            });
        });
    });

    // Add some console logging to verify initialization
    console.log('Loading functionality initialized');
}