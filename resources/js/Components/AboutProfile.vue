<template>
    <div>
        <h2 class="my-7 text-xl">
            <i class="fas fa-id-card-alt mr-3 text-orange-400"></i>
            <span class="uppercase text-orange-400">{{ title }}</span>
        </h2>
        <div class="ml-2 pl-6 border-l-4 border-indigo-400">
            {{ user.profile.about_me }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: Object,
        title: String
    }
};
</script>
