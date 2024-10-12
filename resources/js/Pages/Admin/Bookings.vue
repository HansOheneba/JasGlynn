<template>
    <div class="admin-bookings">
      <h1>Bookings Dashboard</h1>

      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Event Date</th>
            <th>Guests</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="booking in bookings" :key="booking.id">
            <td>{{ booking.name }}</td>
            <td>{{ booking.email }}</td>
            <td>{{ booking.event_date }}</td>
            <td>{{ booking.guests }}</td>
            <td>{{ booking.status }}</td>
            <td>
              <button @click="accept(booking)" v-if="booking.status === 'pending'">Accept</button>
              <button @click="decline(booking)" v-if="booking.status === 'pending'">Decline</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script>
  import { ref } from 'vue';
  import { usePage } from '@inertiajs/inertia-vue3';
  import { Inertia } from '@inertiajs/inertia';

  export default {
    setup() {
      const { bookings } = usePage().props.value;

      const accept = (booking) => {
        Inertia.post(`/admin/bookings/${booking.id}/accept`);
      };

      const decline = (booking) => {
        Inertia.post(`/admin/bookings/${booking.id}/decline`);
      };

      return { bookings, accept, decline };
    },
  };
  </script>

  <style scoped>
  .admin-bookings {
    max-width: 800px;
    margin: 50px auto;
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    padding: 10px;
    border: 1px solid #ddd;
  }
  button {
    margin: 0 5px;
  }
  </style>
