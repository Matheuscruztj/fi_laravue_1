<template>
    <div class="container pt-2 mb-4">
        <b-modal ref="modalExcluir" id="abc">
            <p> Tem certeza que deseja {{ operacao }} esse registro? </p>

            <template v-slot:modal-footer="{ hide , ok }">
                <b-button size="sm" variant="danger" @click="hide()">
                Não
                </b-button>
                <b-button size="sm" variant="primary" @click="ok(); ok2();">
                Sim
                </b-button>
            </template>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: 'Modal',
    props: {
        'operacao': {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            show: false
        }
    },
    methods: {
        ok2() {
            this.$emit('confirmed', true);
        }
    },
}
</script>
