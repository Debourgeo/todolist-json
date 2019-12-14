// Here Drag and grop the box (drag les list)






// Here AJAX submission

/*

Prevent submission by button                         ok
Submission by ticking the checkbox          to do

Prevent the screen refresh
Update the data 

*/

const checkBoxForm = document.getElementById('checkBoxForm');

// Desactivate the submit button and hiding it.
// The form will be submit by ticking the checkbox
const button = document.getElementById('submit_add_archive');
button.addEventListener("click", e => e.preventDefault());
button.style.display = "none";

const arrayOfTodo = document.querySelectorAll(".todo");
// console.log(arrayOfTodo);


const ticking = async () => {
    checkBoxForm.submit()
    // try {
    //     let modificationRequest = await fetch(
    //         "http://0.0.0.0:8000/todolist-json/assets/php/Form_task_to_archive.php", {
    //             method: "POST",
    //             headers: {
    //                 "Content-type": "multipart/form-data",
    //             },
    //             body: new FormData(document.getElementById("checkBoxForm"))
    //         }
    //     )
    // } catch (error) {
    //     console.error(error);
    // }
}



arrayOfTodo.forEach(checkBoxTodo => {
    checkBoxTodo.addEventListener("click", () => ticking());
});