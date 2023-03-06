const complete = document.querySelectorAll(".fa-check")
const text = document.querySelectorAll("p")
const todos = document.querySelectorAll(".todo")


complete.forEach((com,id)=>{

    com.addEventListener("click",()=>{

        text[id].classList.toggle("completed")
        todos[id].classList.toggle("todo-completed")
    })
})
