<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ name }}</div>

                    <div class="panel-body">
                        {{ msg }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: 'Rob',
                msg: 'Hi, how are you?'
            }
        }
    }
</script>
