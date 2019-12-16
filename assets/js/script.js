// Function to submit the form

function onDrop(event) {
    let id = event.dataTransfer.getData("text");

    let draggableElement = document.getElementById(id);
    let dropzone = event.target;
    let dropzoneParent = dropzone.parentNode;
    if (dropzone.classList.contains("dropable")) {
        if (dropzone.classList.contains("label")) {
            dropzoneParent.parentNode.insertBefore(
                draggableElement,
                dropzoneParent.nextSibling
            );
        } else {
            dropzone.parentNode.insertBefore(
                draggableElement,
                dropzone.nextSibling
            );
        }
    }
}

function onDragOver(event) {
    event.preventDefault();
}

function onDragStart(event) {
    event.dataTransfer.setData("text/plain", event.target.id);
}

// Here AJAX submission

/*

Prevent submission by button
Submission by ticking the checkbox

Prevent the screen refresh
Update the data 

*/

let checkBoxForm = document.getElementById("checkBoxForm");

// Desactivate the submit button and hiding it.
// The form will be submit by ticking the checkbox
let button = document.getElementById("submit_add_archive");
button.addEventListener("click", e => e.preventDefault());
button.style.display = "none";

// checkBoxForm.addEventListener("submit", e => e.preventDefault());
