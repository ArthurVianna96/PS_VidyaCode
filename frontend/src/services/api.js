const BASE_URL = 'http://172.17.0.1:3000';

export const fetchClients = async () => {
  const url = `${BASE_URL}/client`;
  const response = await fetch(url);
  const data = await response.json();
  return data;
}

export const registerClient = async (client) => {
  const url = `${BASE_URL}/client`;
  const options = {
    method: 'POST',
    body: JSON.stringify(client)
  }
  const response = await fetch(url, options);
  const data = await response.json();
  return data;
}
