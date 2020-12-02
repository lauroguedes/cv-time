<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-14 px-10">
                    <div class="grid grid-rows-3 grid-flow-col gap-x-4 gap-y-10">
                        <!-- Cabeçalho Currículo -->
                        <div class="col-span-3">
                          <header-profile :user="user"></header-profile>
                        </div>
                        <!-- Detalhles do Currículo -->
                        <div class="row-span-2">
                          
                        </div>
                        <!-- Conteúdo do Currículo -->
                        <div class="row-span-2 col-span-2">
                          <about-profile :user="user"></about-profile>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import HeaderProfile from '@/Components/HeaderProfile.vue';
import AboutProfile from '@/Components/AboutProfile.vue';

export default {
    components: {
        AppLayout,
        HeaderProfile,
        AboutProfile
    },
    props: {
        user: Object
    }
};
</script>
