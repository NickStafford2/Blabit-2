<template>
    <div class="container-fluid blab-post-container bg-light pt-1">
        <!--div class="line-break"></div-->
        <!--input v-model="message" placeholder="edit me"-->        
        <textarea class="blab-input bg-light" type="text" v-model="message" placeholder="blah bhah blah"></textarea>
        <div class="d-flex justify-content-between">
            <i class="fa superchat-button m-2" @click="superchat">&#xf155;</i>    
            <div class="submit-container">
                <p class="character-count">{{messageLength}}/200</p>
                <i class="fa submit-button m-2" @click="store" >&#xf1d8;</i>
            </div>

        </div>
    </div>
</template> 

<script>
    export default {
        props: ['chat_id', 'blabs'],
        data: function() { 
            return {
                message: ''
            }
        },
        computed: {
            // a computed getter
            messageLength: function() {
                return this.message.length;
            }
        },
        methods: {
            store() {
                console.log("Store called");
                if (this.messageLength == 0 ) {
                    alert('nothing to blab. please enter a message');
                }
                else if (this.messageLength > 200) {
                    alert('blab to long. must be under 200 characters');
                }
                else {
                    axios.post('/blabs', {  chat_id: this.chat_id, 
                                            message: this.message})
                    .then((response) => {
                            console.log(response);
                            this.message = '';
                            // Redirect or do something
                         });
                }
            },
            superchat() {
                console.log('have not implemented superchats');
            }
        }
    };
</script>

<style scoped>
    .line-break {
        background-color: black;
        width: 100%;
        height: 1px;

    }
    .blab-input {
        display: block;
        width: 100%;
        overflow-y: auto;
        resize: none;
        border: none;
        outline: none;
        -webkit-box-shadow: none !important;
        -moz-box-shadow: none !important;
        box-shadow: none !important;
        border-bottom: 1px solid;
    }
    .blab-input:after { /* unused delete me */
        background-color: #f1f1f1;
        border: none;
        border-bottom: 1px solid;
    }
    .blab-input:focus { /* unused delete me */
        background-color: #f1f1f1;
        border: none;
        border-bottom: 1px solid;
    }
    .character-count {
        padding: 7px 0px;
        margin: 0;
        display: inline-block;

    }
    .submit-button {
        float:right;
        font-size: 16px;
        color: #bfbfbf;
        display: inline-block;

    }
    .submit-button:hover {
        color: black;
        cursor: pointer;
    }
    .superchat-button {
        font-size: 16px;
        color: #bfbfbf;
        display: inline-block;
    }
    .superchat-button:hover {
        color: green;
        cursor: pointer;
    }

</style>

