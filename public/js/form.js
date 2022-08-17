(function () {
    let vm = new Vue({
        el: '#app',
        data: {
            errors: [],
            formSubmited: false,
            formFields: {
                link: '',
                limit: 0,
                lifetime: 1
            },
            linkList: [],
        },
        mounted() {
            this.linkList = JSON.parse(this.$el.dataset.list);
        },
        methods: {
            sendForm(e) {
                let _this = this, url = e.target.action;
                e.preventDefault();

                _this.formSubmited = true;
                axios.post(url, _this.formFields).then(function (response) {
                    _this.linkList.push(response.data.item);

                    _this.formSubmited = false;
                    _this.resetForm();
                }).catch(_this.defaultErrorResponse)
            },
            resetForm() {
                let _this = this;
                Object.keys(this.formFields).forEach(function(key,index) {
                    _this.formFields[key] = '';
                });
            },
            fieldHasError(key) {
                return this.errors[key] !== undefined;
            },
            getError(key) {
                return this.errors[key] !== undefined ? this.errors[key][0] : '';
            },
            defaultErrorResponse(error) {
                this.formSubmited = false;
                if (error.response !== undefined) {
                    if (error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                }
            }
        }
    });
})();
