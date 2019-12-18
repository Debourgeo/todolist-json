// Reorganise the frame of lists
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

// ******* Drag and Drop function ******* //

function onDragStart(event) {
    event.dataTransfer.setData("text/plain", event.target.id);
}

function onDragOver(event) {
    event.preventDefault();
}

function onDrop(event) {
    const id = event.dataTransfer.getData("text");

    const draggableElement = document.getElementById(id);
    const dropzone = event.target;

    const oldID = id;
    let newID;

    let dropzoneParent = dropzone.parentNode;
    if (dropzone.classList.contains("dropable")) {
        if (dropzone.classList.contains("ul")) {
            // Thx Kevin for the "children"
            newID = dropzone.children[0].id;
            dropzone.insertBefore(draggableElement, dropzone.childNodes[0]);
        } else if (dropzone.classList.contains("label")) {
            newID = dropzoneParent.nextSibling.id;
            newID == undefined ? newID = dropzoneParent.id : 0;
            dropzoneParent.parentNode.insertBefore(
                draggableElement,
                dropzoneParent.nextSibling
            );
        } else {
            newID = dropzone.nextSibling.id;
            newID == undefined ? newID = dropzone.id : 0;
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

// AJAX Submit on ticking the box of the "Todo"
const checkBoxForm = document.getElementById("checkBoxForm");
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