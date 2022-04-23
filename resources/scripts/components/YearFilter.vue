<template>
    <div class="flex flex-col">
        <label>{{ trans('Select the year') }}</label>

        <el-date-picker
            v-model="year"
            type="year"
            @change="onDateSelect"
            :disabled-date="dateIsDisabled"
            class="h-10"
        />
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { trans } from 'laravel-vue-i18n';

type Props = {
    year: Date;
};

type Emits = {
    (eventName: 'onYearChange', year: Date): void;
};

const { year } = defineProps<Props>();

const emit = defineEmits<Emits>();

const minYear = new Date('01/01/1950');
const maxYear = new Date('01/01/1980');

const onDateSelect = (date: Date) => {
    emit('onYearChange', date);
};

const dateIsDisabled = (date: Date) => {
    return date < minYear || date > maxYear;
};
</script>
