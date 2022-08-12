<template>
    <Transition name="fade">
        <div 
                v-if="showing"
                @click.self="close()"
                class="z-10 fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75">
                <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 mx-4 max-w-2xl bg-white dark:bg-slate-900 shadow-lg rounded p-4 animate__animated animate__bounceIn animate__faster">
                    <slot />
                </div>
        </div>
  </Transition>
</template>
 
<script>
export default {
  props: {
    showing: {
      required: true,
      type: Boolean
    }
  },
  emits: ['close'],
  setup(props, {emit}){
        const close = () => {
            emit('close')
        }

        return {
            close
        }
  }
}
</script>

<style scoped>
    .bg-semi-75{
      background: linear-gradient(rgba(42, 42, 78, 0.484), rgba(42, 42, 78, 0.484))
    }

    
</style>