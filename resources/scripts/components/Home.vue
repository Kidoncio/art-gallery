<template>
  <div class="w-full">
    <div class="flex flex-row items-center justify-center gap-6">
      <h1 class="text-4xl font-bold uppercase my-5 text-gray-800">
        <a href="/">{{ trans('Title') }} - {{ trans('Country') }}</a>
      </h1>

      <location-select></location-select>
    </div>

    <div class="flex flex-col md:flex-row items-center justify-around gap-6">
      <year-filter :year="year" @on-year-change="onYearChange"></year-filter>

      <country-filter
        :selected-country="selectedCountry"
        @on-select-country="onSelectCountry"
      ></country-filter>
    </div>
  </div>

  <div class="container mx-auto" v-if="loading">
    <div class="text-center my-20">
      <h3>{{ trans('Loading') }}</h3>
    </div>
  </div>

  <div class="container mx-auto" v-if="!loading">
    <div v-if="artworks.length === 0" class="text-center my-20">
      {{ trans('No results found') }}
    </div>

    <div v-if="artworks.length > 0">
      <gallery :artworks="artworks" />

      <div class="w-full flex flex-col items-center mb-2">
        <el-pagination
          layout="prev, pager, next"
          :current-page="currentPage"
          :page-size="defaultNumberOfResults"
          :total="totalPages"
          @current-change="onCurrentPageChange"
        />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, Ref, reactive, watch } from 'vue';
import { trans } from 'laravel-vue-i18n';
import { Country } from '@/scripts/types/Country';
import { Artwork } from '@/scripts/types/Artwork';
import axios from 'axios';

const selectedCountry: Ref<Country> = reactive(
  ref({
    flag: '🇵🇹',
    name: {
      common: 'Portugal',
    },
  })
);
const year: Ref<Date> = reactive(ref(new Date('01/01/1960')));
const currentPage: Ref<number> = reactive(ref(1));
const totalPages: Ref<number> = reactive(ref(0));
const artworks: Ref<Artwork[]> = reactive(ref([]));
const loading: Ref<boolean> = reactive(ref(false));
const defaultNumberOfResults: Ref<number> = ref(15);

const getArtworks = async () => {
  loading.value = true;

  const fieldsToReturn = [
    'id',
    'title',
    'image_id',
    'thumbnail',
    'artist_display',
    'place_of_origin',
  ];

  const queryPage =
    currentPage.value === 1
      ? 0
      : currentPage.value * defaultNumberOfResults.value;

  let queryArtwork = `${selectedCountry.value.name.common}`;
  queryArtwork += ' AND ';
  queryArtwork += `${year.value.getFullYear()}`;

  const response = await axios.get<{
    data: Artwork[];
    pagination: { total_pages: number };
  }>(`/api/artworks`, {
    params: {
      q: queryArtwork,
      fields: fieldsToReturn.join(','),
      from: queryPage,
      size: defaultNumberOfResults.value,
    },
  });

  loading.value = false;

  if (response.status !== 200) return;

  artworks.value = [...response.data.data];

  totalPages.value = response.data.pagination.total_pages;
};

getArtworks();

watch(
  () => selectedCountry.value,
  () => {
    currentPage.value = 1;

    getArtworks();
  }
);

watch(
  () => year.value,
  () => {
    currentPage.value = 1;

    if (!year.value) year.value = new Date('01/01/1960');

    getArtworks();
  }
);

watch(
  () => currentPage.value,
  () => {
    getArtworks();
  }
);

const onSelectCountry = (country: Country) => {
  selectedCountry.value = country;
};

const onYearChange = (value: Date) => {
  year.value = value;
};

const onCurrentPageChange = (value: number) => {
  currentPage.value = value;
};
</script>
