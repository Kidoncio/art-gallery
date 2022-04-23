<script setup lang="ts">
import { Artwork } from '@/scripts/types/Artwork';

type Props = {
    artworks: Artwork[];
};

const props = defineProps<Props>();

const artworks = props.artworks || []
</script>

<template>
    <div
        :class="`grid-cols-3 p-4 space-y-2 lg:space-y-0 lg:grid lg:gap-3 lg:grid-rows-${
            artworks.length / 3
        } text-center`"
        v-if="artworks.length > 0"
    >
        <div
            class="w-full rounded"
            v-for="artwork in artworks"
            :key="artwork.image_id"
        >
            <el-image
                style="width: 20rem; height: 20rem"
                :src="`https://www.artic.edu/iiif/2/${artwork.image_id}/full/843,/0/default.jpg`"
                :alt="artwork?.thumbnail?.alt_text"
                fit="fill"
                lazy
            >
                <template #error>
                    <div class="image-slot">
                        <el-icon><icon-picture /></el-icon>
                    </div>
                </template>
            </el-image>

            <div class="text-center">
                <p class="font-base">{{ artwork.title }}</p>
                <p class="font-xs">{{ artwork.artist_display }}</p>
            </div>
        </div>
    </div>
</template>
