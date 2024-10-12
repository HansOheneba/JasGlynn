<template>
  <div class="booking-form">
    <h1>Book Your Event</h1>
    <form @submit.prevent="submitBooking">
      <input v-model="form.name" type="text" placeholder="Your Name" required />
      <input v-model="form.email" type="email" placeholder="Your Email" required />
      <input v-model="form.event_date" type="date" required />
      <input v-model="form.guests" type="number" placeholder="Number of Guests" required />
      <button type="submit">Submit</button>
    </form>

    <p v-if="successMessage">{{ successMessage }}</p>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  setup() {
    const form = ref({ name: '', email: '', event_date: '', guests: 1 });
    const successMessage = ref('');

    const submitBooking = async () => {
      try {
        await axios.post('/book', form.value);
        successMessage.value = 'Booking submitted successfully!';
        form.value = { name: '', email: '', event_date: '', guests: 1 };
      } catch (error) {
        console.error(error);
      }
    };

    return { form, successMessage, submitBooking };
  },
};
</script>

<style scoped>
.booking-form {
  max-width: 400px;
  margin: 50px auto;
  text-align: center;
}
input, button {
  display: block;
  width: 100%;
  margin: 10px 0;
  padding: 10px;
}
button {
  background-color: #333;
  color: white;
  border: none;
  border-radius: 5px;
}
</style>
