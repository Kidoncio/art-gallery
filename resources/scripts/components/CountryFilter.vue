<template>
  <div class="flex flex-col">
    <label>{{ trans('Select the country') }}</label>

    <AutoComplete
      v-model="selectedCountry"
      :suggestions="filteredCountries"
      @complete="searchCountry($event)"
      :dropdown="true"
      field="name.common"
      forceSelection
      @item-select="selectCountry"
    >
      <template #item="slotProps">
        <div class="country-item">
          <div class="ml-2">
            {{ slotProps.item.flag }}
            {{ slotProps.item.name.common }}
          </div>
        </div>
      </template>
    </AutoComplete>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, Ref, reactive } from 'vue';
import { Country } from '@/scripts/types/Country';
import { trans } from 'laravel-vue-i18n';
import axios from 'axios';
import {
  AutoCompleteCompleteEvent,
  AutoCompleteItemUnselectEvent,
} from 'primevue/autocomplete';
import { countriesMock } from '../countriesMock';

type Props = {
  selectedCountry: Country;
};

type Emits = {
  (eventName: 'onSelectCountry', country: Country): void;
};

const { selectedCountry } = defineProps<Props>();
const emit = defineEmits<Emits>();

const countries = countriesMock.sort((a: Country, b: Country) => {
      if (a.name.common < b.name.common) {
        return -1;
      }

      if (a.name.common > b.name.common) {
        return 1;
      }

      return 0;
    });

const filteredCountries: Ref<Country[]> = ref(countries);

const selectCountry = (event: AutoCompleteItemUnselectEvent) => {
  emit('onSelectCountry', event.value);
};

const searchCountry = (event: AutoCompleteCompleteEvent) => {
  if (!event.query.trim().length) {
    filteredCountries.value = [...countries];
  } else {
    filteredCountries.value = countries.filter((country: Country) => {
      return country.name.common
        .toLowerCase()
        .startsWith(event.query.toLowerCase());
    });
  }
};
</script>
