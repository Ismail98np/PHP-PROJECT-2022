//get the table in the page
const drivingInstructors = document.getElementById("table")


if (drivingInstructors) {
    //click event
    drivingInstructors.addEventListener('click', e => {
        //if click was on a delete button
        if (e.target.className === 'btn btn-danger delete-instructor') {
            //asks user to confirm action
            if (confirm("are you sure you want to delete this instructor")) {
                id = e.target.getAttribute('data-id')

                //delete is actioned
                fetch(`/di/delete/${id}`, {
                        method: 'DELETE'
                    })
                    .then(res => window.location.reload())

            }
            alert("Instructor has been deleted");
        }
    })
}