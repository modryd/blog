/* <!-- Modal Container -->
<div id="image-modal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modal-image">
</div>*/
const createModalContainer = () => {
    if (document.getElementById('image-modal')) {
        return;
    }

    var modalContainer = document.createElement('div');
    modalContainer.id = 'image-modal';
    modalContainer.className = 'modal';

    var closeBtn = document.createElement('span');
    closeBtn.className = 'close';
    closeBtn.innerHTML = '&times;';
    modalContainer.appendChild(closeBtn);

    var modalImage = document.createElement('img');
    modalImage.className = 'modal-content';
    modalContainer.appendChild(modalImage);

    document.body.appendChild(modalContainer);
}

document.addEventListener('DOMContentLoaded', function() {
    createModalContainer();

    var modal = document.getElementById('image-modal');
    var img = document.getElementById('home-image');
    var modalImg = document.getElementsByClassName('modal-content')[0];
    var closeBtn = document.getElementsByClassName('close')[0];

    img.onclick = function() {
        modal.style.display = 'block';
        modalImg.src = this.src;
    }

    closeBtn.onclick = function() {
        modal.style.display = 'none';
    }

    modal.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
});