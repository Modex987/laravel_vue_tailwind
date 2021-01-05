let cleanTodo = (todo) => {
    delete todo.uuid
    for(let key in todo){
        if(todo[key] == null){
            delete todo[key]
        }
    }
    return todo
}

export default cleanTodo