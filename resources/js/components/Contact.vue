<template>

    <div>

        <form class="form mt-10" action="#" @submit.prevent="sendContact">

            <div class="form__row">
                <div class="form__input-group">
                    <div class="form__label-group">
                        <p><label for="name" class="">Nome <abbr title="Obrigatório">*</abbr></label>
                        </p>
                    </div><input v-model="formData.name" id="name" autocomplete="false" tabindex="0" class="form__input">
                </div>
            </div>

            <div class="form__row">
                <div class="form__input-group">
                    <div class="form__label-group">
                        <p><label for="email" class="">Email <abbr title="Obrigatório">*</abbr></label>
                        </p>
                    </div><input v-model="formData.email" id="email" name="email" autocomplete="false" tabindex="0"
                        class="form__input" required>
                </div>
            </div>

            <div class="form__row">
                <div class="form__input-group">
                    <div class="form__label-group">
                        <p><label for="subject" class="subject">Assunto <abbr
                                    title="Obrigatório">*</abbr></label></p>
                    </div><input v-model="formData.subject" id="subject" name="subject" autocomplete="false" tabindex="0"
                        class="form__input" required>
                </div>
            </div>

            <div class="form__row">
                <div class="form__input-group">
                    <div class="form__label-group">
                        <p><label for="message" class="bg-white text-gray-600 px-1">Mensagem <abbr
                                    title="Obrigatório">*</abbr></label></p>
                    </div><textarea v-model="formData.message" id="message" name="message" class="form__input" rows="4"
                        required></textarea>
                </div>
            </div>

            <div class="mt-6 pt-3 text-center">
                <button class="button button--filled button--primary"
                    :class="{ 'cursor-not-allowed' : preloader }"
                    type="submit"
                    :disabled="preloader">
                    <span v-if="preloader">Enviando...</span>
                    <span v-else>Enviar</span>
                </button>
            </div>

            <div v-if="messageSuccess">{{ messageSuccess }}</div>
            <div v-if="messageFail">{{ messageFail }}</div>

        </form> <!-- form mt-10 -->

    </div> <!-- -->

</template> <!-- -->

<script>

export default {

    data () {

        return {

            formData: {

                preloader: false,

                name: '',
                email: '',
                subject: '',
                message: ''

            }, // formData

            messageSuccess: '',
            messageFail: ''

        } // return

    }, // data

    methods: {

        sendContact () {

            this.messageSuccess = ''
            this.messageFail = ''

            this.preloader = true

            axios.post( '/api/v1/contact', this.formData )
                    .then( response => this.messageSuccess = 'Contato enviado com sucesso!' )
                    .catch( error => this.messageFail = 'Ops... algo errado!' )
                    .finally( () => {

                        this.preloader = false

                        this.reset()

                    })

        }, // sendContact

        reset () {

            this.formData = {

                name: '',
                email: '',
                subject: '',
                message: ''

            } // formData

        } // reset

    }, // methods

} // export default

</script>

<style scoped>

</style>
