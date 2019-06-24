<template>
    <div class="input-container" :class="{ focus }"> <!-- add class when focus is true -->
        <i 
            class="submit-button fas fa-caret-right fa-2x"
            @click="submit"
        >&#xf0da;</i>
        <div class="input-wrapper">
            <input
                class="m-input"
                type="text"
                v-model="value"
                :placeholder="placeholder"
                @focus="inputEvent" 
                @focusout="inputEvent"
                @keyup="inputEvent"
            >
        </div>
        
    </div>
</template>

<script>
export default {
    props: {
        placeholder: null,
        //eventName: {required: true}
    },

    data() {
        return {
            focus: false, 
            value: ''
        }
    },
    methods: {
        inputEvent(e) {
            //this.$emit('inputEvent', e);
            if ((e.type == 'focus' || e.type == 'keyup') && this.value.length > 0) {
                // activate the effect
                this.focus = true;
                if (e.type == 'keyup' && e.code == 'Enter') {
                    this.submit();
                }
            }
            else {
                this.focus = false;
            }
        },
        submit() {
            this.$emit('inputSubmit', this.value);
            this.value = '';
        }
    }
};
</script>

<style lang="scss" scoped>
$primary: #b2b2b2;
$accent: #000;

.input-container {
    position: relative;
    padding: 5px 0;
    margin-bottom: 5px;



    &::before, &::after {
        content: ' ';
        position: absolute;
        bottom: 0;
        border-bottom: 2px $primary solid;
        transition: .3s;
    }

    &::after {
        left: 50%;
        right: 50%;
        border-bottom: 2px $accent solid;
    }

    &::before, &.focus::after {
        left: 0;
        right: 0;
    }

    input[type='text'] {
        border: 0;
        outline: 0;
        background-color: transparent;
        font-family: 'Segoe UI', 'San Francisco', 'Roboto', sans-serif;
        font-size: 1em;
        width: 100%;
        color: $accent;
    }
}

.my-input {
    width: 100%;
}
.submit-button {
    float: right;
            //font-size: 16px;
        color: #bfbfbf;

}
.submit-button:hover {
    color: black;
    cursor: pointer;
}

.input-wrapper {
    overflow: hidden; 
    padding-right: .5em;
}

::placeholder {
    color: $primary;
}
</style>