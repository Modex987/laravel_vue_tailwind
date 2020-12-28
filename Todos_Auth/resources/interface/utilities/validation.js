class Field
{
    constructor(name = 'input', is_valid = true, val = null, errors = []){
        this.name = name
        this.is_valid = is_valid
        this.val = val
        this.errors = errors
    }

    reset(){
        this.is_valid = true
        this.errors = []
    }

    require(msg){
        if(!this.val){
            this.is_valid = false
            this.errors.push(msg)
        }
        return this
    }

    min(k, msg){
        if(this.val && this.val.length < k){
            this.is_valid = false
            this.errors.push(msg)
        }
        return this
    }

    max(k, msg){
        if(this.val && this.val.length > k){
            this.is_valid = false
            this.errors.push(msg)
        }
        return this
    }

    sameAs(field, msg){
        if(this.val != field.val){
            this.is_valid = false
            this.errors.push(msg)
        }
        return this
    }
}

export default Field