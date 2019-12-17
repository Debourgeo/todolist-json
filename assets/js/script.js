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

const checkBoxForm = document.getElementById('checkBoxForm');

// Desactivate the submit button and hiding it.
// The form will be submit by ticking the checkbox
const button = document.getElementById('submit_add_archive');
button.addEventListener("click", e => e.preventDefault());
button.style.display = "none";



/// ***********************************************************************************
/// ***********************************************************************************
/// ***********************************************************************************
/// ***********************************************************************************


const reorganization = (list) => {
    let theClass;
    if (list == "todo") {
        theClass = "todo";
        idForm = "#checkBoxForm";
    } else {
        theClass = "done";
        idForm = "#doneForm";
    }
    let target = document.querySelectorAll(`${idForm} ul li input`);
    let parentTarget = target.parentNode
    target.forEach((input, i) => {
        input.name = `${i}`;
        input.id = `${theClass}${i}`;
        input.class = `${theClass}`;
        parentTarget.id = `li${theClass}${i}`
    })
}

document.querySelectorAll(".todo").forEach(checkBoxTodo => {
    checkBoxTodo.addEventListener("click", () => {
        // Sending formData to the back to operate on the DataBase
        try {
            const data = new FormData(checkBoxForm);
            fetch("assets/php/Form_task_to_archive.php", {
                method: "POST",
                body: data
            });
            // Moving the node to represent the sent data.
            const toMove = checkBoxTodo.parentNode;
            let target = document.querySelector('#doneForm ul li');
            target.parentNode.insertBefore(toMove, target);
            // Reorganization of the data: name, id, class!
            reorganization("todo");
            reorganization("done");
        } catch (error) {
            console.error(error);
        }
    });
});