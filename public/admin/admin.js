$(document).ready(function() {
    $(".nav-treeview .nav-link, .nav-link").each(function() {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if (link == location2) {
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');

        }
    });

    $('.delete-btn').click(function() {
        var res = confirm('Подтвердите действия');
        if (!res) {
            return false;
        }
    });
})

let btnCounter = 1;
$('#addMoreImagesBtn').click(function() {
    btnCounter++;
    $(this).before(`
    <div class="col-sm-4 mb-2">
        <div class="custom-file" class="custom-file-input">
            <input type="file" class="custom-file-input" class="imageInput" name="images[]" id="image_${btnCounter}" accept="image/png, image/jpeg">
            <label class="custom-file-label" for="image_${btnCounter}">Choose image ${btnCounter}</label>
        </div>
    </div>
    `);

    showFileNamesInInputs();
})

$('.moreDescription').click(function() {
    $(this).toggleClass('truncate-text');
    $(this).toggleClass('pb-12');
})

function showFileNamesInInputs() {
    const uploaders = document.querySelectorAll(".custom-file-input")

    uploaders.forEach(uploader => {
        uploader.addEventListener('change', () => {
            const label = document.querySelector(`label[for="${uploader.id}"]`)
            label.innerHTML = uploader.files[0].name
        })
    })
}
showFileNamesInInputs();