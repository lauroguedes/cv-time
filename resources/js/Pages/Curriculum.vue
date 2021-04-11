<template>
  <app-layout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-14 px-10"
        >
          <div class="grid grid-cols-12 gap-x-4 gap-y-10">
            <!-- Cabeçalho Currículo -->
            <div class="col-span-12">
              <header-profile :user="user"></header-profile>
            </div>
            <!-- Detalhles do Currículo -->
            <div class="col-span-3">
              <details-profile title="Details" :user="user"></details-profile>
              <links title="Links" :links="user.links"></links>
              <skills title="Skills" :skills="user.skills"></skills>
              <hobbies title="Hobbies" :user="user"></hobbies>
              <languages
                title="languages"
                :languages="user.languages"
              ></languages>
            </div>
            <!-- Conteúdo do Currículo -->
            <div class="col-span-9">
              <about-profile title="About me" :user="user"></about-profile>
              <employment-history
                title="Employment History"
                :employmentHistories="user.employment_histories"
              ></employment-history>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import HeaderProfile from "@/Components/HeaderProfile";
import AboutProfile from "@/Components/AboutProfile";
import DetailsProfile from "@/Components/DetailsProfile";
import EmploymentHistory from "@/Components/EmploymentHistory";
import Links from "@/Components/Links";
import Skills from "@/Components/Skills";
import Hobbies from "@/Components/Hobbies";
import Languages from "@/Components/Languages";

export default {
  components: {
    AppLayout,
    HeaderProfile,
    AboutProfile,
    DetailsProfile,
    EmploymentHistory,
    Links,
    Skills,
    Hobbies,
    Languages,
  },
  props: {
    user: Object,
  },
};
</script>
