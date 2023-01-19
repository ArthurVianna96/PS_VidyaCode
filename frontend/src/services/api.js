const BASE_URL = 'http://172.17.0.1:3000';

export const fetchClients = async () => {
  const url = `${BASE_URL}/client`;
  const response = await fetch(url);
  const data = await response.json();
  return data;
}
