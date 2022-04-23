<script setup lang="ts">
import { getActiveLanguage, loadLanguageAsync } from 'laravel-vue-i18n';
import { reactive, ref, watch } from 'vue';

const selectedLanguage = reactive(ref(getActiveLanguage()));

const languageOptions = [
    {
        label: 'Português (PT)',
        value: 'pt',
    },
    {
        label: 'Português (BR)',
        value: 'pt_BR',
    },
];

watch(
    () => selectedLanguage.value,
    (newValue: string) => {
        loadLanguageAsync(newValue);
    }
);
</script>

<template>
    <el-select
        v-model="selectedLanguage"
        class="m-2"
        placeholder="Select"
        size="large"
    >
        <el-option
            v-for="language in languageOptions"
            :key="language.value"
            :label="language.label"
            :value="language.value"
        />
    </el-select>
</template>
