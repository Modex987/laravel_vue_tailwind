import { onMounted, ref } from "vue"

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

            setup(){

            }
        }
    },
}

export default Mixin