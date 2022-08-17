@extends('layouts.main')
@section('content')
    <div class="container" id="app" data-list="{{ $list }}">
        <h1>{{ @trans('short_link.title') }}</h1>
        <form class="row g-3 mt-5" action="{{ route('link.create') }}" method="POST" @submit="sendForm">
            <div class="col-md-4">
                <label for="link" class="form-label">{{ @trans('short_link.form.link') }}</label>
                <input type="text" class="form-control" id="link" v-model="formFields.link"
                       :class="fieldHasError('link') ? 'is-invalid': ''"
                >
                <div v-if="fieldHasError('link')" class="invalid-feedback">@{{ getError('link') }}</div>
            </div>
            <div class="col-md-4">
                <label for="limit" class="form-label">{{ @trans('short_link.form.limit') }}</label>
                <input type="number" class="form-control" id="limit" v-model="formFields.limit"
                       :class="fieldHasError('limit') ? 'is-invalid': ''"
                >
                <div v-if="fieldHasError('limit')" class="invalid-feedback">@{{ getError('limit') }}</div>
            </div>
            <div class="col-md-4">
                <label for="lifetime" class="form-label">{{ @trans('short_link.form.lifetime') }}</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">hour's:</span>
                    <input type="number" min="1" class="form-control" id="lifetime" v-model="formFields.lifetime"
                           :class="fieldHasError('lifetime') ? 'is-invalid': ''"
                    >
                    <div v-if="fieldHasError('lifetime')" class="invalid-feedback">@{{ getError('lifetime') }}</div>
                </div>
            </div>
            <div class="col-12 text-right">
                <button class="btn btn-primary" type="submit" :disabled="formSubmited">Submit form</button>
            </div>
        </form>
        <div class="row g-3 mt-5">
            <div class="col-md-12" v-show="linkList.length">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Link</th>
                        <th scope="col">Shot link</th>
                        <th scope="col">Limit</th>
                        <th scope="col">Count entrance</th>
                    </tr>
                    </thead>
                    <tbody v-for="(item, index) in linkList">
                    <tr>
                        <th scope="row">@{{ index + 1 }}</th>
                        <td>@{{ item.link }}</td>
                        <td><a :href="item.short_link" target="_blank">@{{ item.short_link }}</a></td>
                        <td>@{{ item.limit }}</td>
                        <td>@{{ item.count_entrance }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/form.js') }}" ></script>
@endsection
