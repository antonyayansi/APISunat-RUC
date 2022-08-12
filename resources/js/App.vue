<template>
    <div>
        <CardModal
            :showing="isOpen"
            @close="isOpen = false"
            >
            <h1 class="font-bold py-2 border-b">Generar token</h1>
            <form @submit.prevent="onGenerateToken()" class="my-2 flex flex-wrap">
                <div class="w-full space-y-2">
                    <label for="plan" class="text-gray-600">Plan / Cantidad de consultas</label>
                    <select v-model="new_token.limit" name="" id="" class="w-full outline-none rounded border border-gray-300">
                        <option value="100" :disabled="user.plan != 0">Free (100)</option>
                        <option value="1000" :disabled="user.plan != 1">Basic (1,000)</option>
                        <option value="10000" :disabled="user.plan != 2">Estandar (10,000)</option>
                        <option value="20000" :disabled="user.plan != 3">Premium (20,000)</option>
                    </select>
                </div>
                <div class="w-full pt-2">
                    <button
                        :class="{'opacity-50' : isGenerate}" 
                        :disabled="isGenerate" 
                        class="w-full p-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded">Generar</button>
                </div>
            </form>
        </CardModal>
        <div class="flex items-center justify-start">
            <button
                @click="isOpen = true"
                :class="{'opacity-50 hover:bg-lime-500' : isGenerate}" 
                :disabled="isGenerate"
                class="bg-lime-500 hover:bg-lime-600 text-white rounded p-2">
                <span v-if="!isGenerate">Generar Token</span>
                <span v-else>Generando...</span>
            </button>
        </div>
        <div class="py-4">
            <div class="overflow-x-auto">
                <table class="border-collapse w-full">
                    <tr class="text-sm border-b-2 border-gray-300">
                        <th class="py-2 bg-gray-100">ID</th>
                        <th class="py-2 bg-gray-100">Token</th>
                        <th class="py-2 bg-gray-100">Consultas</th>
                        <th class="py-2 bg-gray-100">Limite</th>
                        <th class="py-2 bg-gray-100">Estado</th>
                    </tr>
                    <tr v-for="token in tokens" :key="token" class="border-b text-sm">
                        <td class="p-2 text-center">{{ token.id }}</td>
                        <td class="p-2 text-center w-1/2 ">
                            <input type="text" class="w-full text-sm bg-gray-100 border-gray-300 rounded-md" v-model="token.token" disabled>
                        </td>
                        <td class="p-2 text-center">
                            {{ token.consult }}  
                        </td>
                        <td class="p-2 text-center">{{ token.limite }}</td>
                        <td class="p-2 text-center">
                            <h1 v-if="token.estado === 1" class="bg-lime-100 text-lime-600 rounded">Activo</h1>
                            <h1 v-else class="text-red-500">Inactivo</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import CardModal from './components/CardModal.vue';
import { useToast } from 'vue-toastification'

export default {
    setup() {
        const isGenerate = ref(false);
        const isOpen = ref(false)
        const toast = useToast()

        const user = ref({id: null})
        const tokens = ref([])

        const new_token = ref({
            user_id: '',
            limit: '',
            credit:'',
            consult: ''
        })

        const setTokens = async (user_id) => {
            await axios.get('/api/tokens/' + user_id).then(resp => {
                tokens.value = resp.data
            })        
        }

        const onGenerateToken = async () => {
            isGenerate.value = true
            new_token.value.user_id = user.value.id,
            new_token.value.credit = new_token.value.limit,
            new_token.value.consult = 0

            await axios.post('/api/generate', new_token.value).then(resp => {
                if(resp.data.status == false){
                    toast.error(resp.data.message)
                }else {
                    toast.success(resp.data.message)
                }
                isOpen.value = false
                setTokens(user.value.id)
                isGenerate.value = false
            })
        }

        onMounted(() => {
            let meta = document.head.querySelector('meta[name="user"]');

            if(meta.content){
                user.value = JSON.parse(meta.content)
                setTokens(user.value.id)
            }
        })

        return {
            isGenerate,
            isOpen,
            onGenerateToken,
            new_token,
            tokens,
            user
        };
    },
    components: { CardModal }
}

</script>