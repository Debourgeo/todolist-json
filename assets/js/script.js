// Function to submit the form

function onDrop(event) {
    let id = event.dataTransfer.getData("text");

    let draggableElement = document.getElementById(id);
    let dropzone = event.target;

    let oldID = id;
    let newID;

    let dropzoneParent = dropzone.parentNode;
    if (dropzone.classList.contains("dropable")) {
        if (dropzone.classList.contains("ul")) {
            newID = dropzone.childNodes[0].id;
            dropzone.insertBefore(draggableElement, dropzone.childNodes[0]);
        } else if (dropzone.classList.contains("label")) {
            newID = dropzoneParent.nextSibling.id;
            dropzoneParent.parentNode.insertBefore(
                draggableElement,
                dropzoneParent.nextSibling
            );
        } else {
            newID = dropzone.nextSibling.id;
            dropzone.parentNode.insertBefore(
                draggableElement,
                dropzone.nextSibling
            );
        }
        const data = new FormData();
        data.append("oldID", oldID);
        data.append("newID", newID);
        try {
            fetch("assets/php/reorder_DB.php", {
                method: "POST",
                body: data
            });
        } catch (error) {
            console.error(error);
        }
        // Reorganization of the data: name, id, class!
        reorganization();
    }
}

function onDragOver(event) {
    event.preventDefault();
}

function onDragStart(event) {
    event.dataTransfer.setData("text/plain", event.target.id);
}

// get position of elements before and after

const getPositions = () => {};

// Here AJAX submission

/*

Prevent submission by button
Submission by ticking the checkbox

Prevent the screen refresh
Update the data 

*/

const checkBoxForm = document.getElementById("checkBoxForm");

// Desactivate the submit button and hiding it.
// The form will be submit by ticking the checkbox

// Remake all the frame of the list
const reorganization = () => {
    let arrlist = ["todo", "done"];
    arrlist.forEach(list => {
        let theClass;
        let idForm;
        if (list == "todo") {
            theClass = "todo";
            idForm = "#checkBoxForm";
        } else {
            theClass = "done";
            idForm = "#doneForm";
        }
        let target = document.querySelectorAll(`${idForm} ul li input`);
        target.forEach((input, i) => {
            let parentTarget = input.parentNode;
            input.name = `${i}`;
            input.id = `${theClass}${i}`;
            input.class = `${theClass}`;
            parentTarget.id = `li${theClass}${i}`;
        });
    });
};

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
            let target = document.querySelector("#doneForm ul li");
            target.parentNode.insertBefore(toMove, target);
            // Reorganization of the data: name, id, class!
            reorganization();
        } catch (error) {
            console.error(error);
        }
    });
});
