<template>
    <div :class="color">
        <div class="card-header">
            <div class="row">
                <div class="col-auto">
                    <h5 class="card-title">{{ title }}</h5>
                </div>
                <div class="col">
                    <div class="float-right float-end">
                        <button type="button" class="btn btn-tool p-1" @click="set(true)">
                            <i class="fa fa-check-square"></i>
                        </button>
                        <button type="button" class="btn btn-tool p-1" @click="set(false)">
                            <i class="fa fa-square"></i>
                        </button>
                        <button type="button" class="btn btn-tool p-1" data-card-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <template v-for="mp in modulepermissions">
                <div class="form-check" v-if="shouldShow(mp)" :key="mp.name">
                    <input :id="mp.name" class="form-check-input" type="checkbox" v-model="mp.enabled" />
                    <label :for="mp.name" class="form-check-label">{{ mp.p.description }}</label>
                </div>
            </template>
        </div>
        <div class="card-footer">
            <a href="javascript:void(0);" @click="set(true)">Todos</a> |
            <a href="javascript:void(0);" @click="set(false)">Ninguno</a>
        </div>
    </div>
</template>
<script>
export default {
    props: ["modulepermissions", "title", "rolemodulepermissions"],
    methods: {
        set: function (bool) {
            this.modulepermissions.map((mp) => {
                mp.enabled = bool;
            });
        },
        shouldShow: function (mp) {
            return !mp.p.parent || !this.allPermissions.includes(mp.p.parent);
        },
    },
    computed: {
        allPermissions: function () {
            if (!this.modulepermissions) {
                return [];
            }
            return this.modulepermissions.map((mp) => mp.permission);
        },
        color: function () {
            var clase = "card collapsed-card card-outline ";

            if (!this.modulepermissions) {
                return clase;
            }
            let all = this.modulepermissions.reduce((carry, mp) => {
                if (!mp.p.parent_id) {
                    return carry + 1;
                }
                return carry;
            }, 0);

            let selected = this.modulepermissions.reduce((carry, mp) => {
                if (mp.enabled && !mp.p.parent_id) {
                    return carry + 1;
                }
                return carry;
            }, 0);

            if (all == selected) {
                return clase + "card-success";
            } else if (selected == 0) {
                return clase + "card-danger";
            }
            return clase + "card-warning";
        },
    },
};
</script>
