const Mixin = {
    methods: {
        alrt(msg = 'Some Thing Went Wrong'){
            this.alert.visible = true
            this.alert.msg = msg
            this.timeOut = setTimeout(()=>{
                this.alert.visible = false
            }, 5000)
        },
    },

    data(){
        return {
            alert: {
                visible: false,
                msg: null
            },

            timeOut: null,

            csrf: document.querySelector('meta[name=csrf-token]').getAttribute('content')
        }
    },
}

export default Mixin