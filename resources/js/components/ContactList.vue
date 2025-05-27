<template>
  <div>
    <form @submit.prevent="addContact" novalidate>
      <div class="row mb-3">
        <div class="col">
          <input v-model="form.first_name" type="text" class="form-control" placeholder="First Name">
          <div v-if="errors.first_name" class="text-danger small">{{ errors.first_name }}</div>
        </div>
        <div class="col">
          <input v-model="form.last_name" type="text" class="form-control" placeholder="Last Name" required>
          <div v-if="errors.last_name" class="text-danger small">{{ errors.last_name }}</div>
        </div>
      </div>
      <div v-for="(phone, idx) in form.phones" :key="idx" class="input-group mb-2">
        <input v-model="form.phones[idx]" type="text" class="form-control" placeholder="Телефон" required>
        <div v-if="errors.phones && errors.phones[idx]" class="text-danger small">{{ errors.phones[idx] }}</div>
        <button v-if="form.phones.length > 1" class="btn btn-danger" type="button" @click="removePhone(idx)">-</button>
        <button v-if="idx === form.phones.length - 1" class="btn btn-success" type="button" @click="addPhone">+</button>
      </div>
      <button class="btn btn-primary" type="submit">Add</button>
    </form>

    <table class="table table-striped table-bordered mt-4">
      <thead>
      <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phones</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(contact, idx) in contacts" :key="contact.id">
        <td>{{ idx + 1 }}</td>
        <td>{{ contact.first_name }}</td>
        <td>{{ contact.last_name }}</td>
        <td>
          <ul>
            <li v-for="phone in contact.phones" :key="phone.id">{{ phone.number }}</li>
          </ul>
        </td>
        <td>
          <button class="btn btn-sm btn-warning" @click="editContact(contact)">Edit</button>
          <button class="btn btn-sm btn-danger" @click="deleteContact(contact.id)">Delete</button>
        </td>
      </tr>
      </tbody>
    </table>

    <nav>
      <ul class="pagination">
        <li class="page-item" :class="{disabled: page.value === 1}">
          <button class="page-link" @click="loadContacts(page.value - 1)">Previous</button>
        </li>
        <li class="page-item" :class="{disabled: page.value === lastPage.value}">
          <button class="page-link" @click="loadContacts(page.value + 1)">Next</button>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import axios from 'axios'

const contacts = ref([])
const page = ref(1)
const lastPage = ref(1)
const form = reactive({
  first_name: '',
  last_name: '',
  phones: ['']
})
const errors = reactive({})

const loadContacts = (newPage = 1) => {
  axios.get(`/contacts?page=${newPage}`).then(res => {
    contacts.value = res.data.contacts.data
    page.value = res.data.contacts.current_page
    lastPage.value = res.data.contacts.last_page
  })
}

const addPhone = () => {
  form.phones.push('')
}

const removePhone = (idx) => {
  form.phones.splice(idx, 1)
}

const validateForm = () => {
  let localErrors = {}

  if (!form.first_name || form.first_name.length < 2) {
    localErrors.first_name = 'First name is required (min 2 symbols)'
  }
  if (!form.last_name || form.last_name.length < 2) {
    localErrors.last_name = 'Last name is required (min 2 symbols)'
  }

  let phoneRegexp = /^\+?[0-9\s\-\(\)]{7,20}$/
  form.phones.forEach((phone, idx) => {
    if (!phone || !phoneRegexp.test(phone)) {
      if (!localErrors.phones) localErrors.phones = {}
      localErrors.phones[idx] = 'Enter a valid phone'
    }
  })

  // Очищуємо errors
  for (const key in errors) delete errors[key]
  Object.assign(errors, localErrors)

  return Object.keys(localErrors).length === 0
}

const addContact = () => {
  if (!validateForm()) {
    return
  }
  axios.post('/contacts', form)
      .then(() => {
        form.first_name = ''
        form.last_name = ''
        form.phones = ['']
        for (const key in errors) delete errors[key]
        loadContacts()
      })
      .catch(e => {
        if (e.response?.data?.errors) {
          for (const key in errors) delete errors[key]
          Object.assign(errors, e.response.data.errors)
        }
      })
}
const deleteContact = (id) => {
  if (confirm('Delete this contact?')) {
    axios.delete(`/contacts/${id}`).then(() => loadContacts())
  }
}
onMounted(() => {
  loadContacts()
})
</script>

<style scoped>
@media (max-width: 768px) {
  .table {
    font-size: 14px;
  }
}
</style>