import { ref } from 'vue';

export default function useCustomers() {
    const customers = ref({})
    const customersMeta = ref({})
    const customersLinks = ref({})

    const getCustomers = async () => {
        axios.get('/customers')
            .then(response => {
                customers.value = response.data.data
                customersMeta.value = response.data.meta
                customersLinks.value = response.data.links
            })
    }

    return { customers, customersMeta, customersLinks, getCustomers }
}
