const BASE_URL = 'http://172.17.0.1:3000';

export const fetchClients = async () => {
  const url = `${BASE_URL}/client`;
  const response = await fetch(url);
  const data = await response.json();
  return data;
}

export const fetchProducts = async () => {
  const url = `${BASE_URL}/product`;
  const response = await fetch(url);
  const data = await response.json();
  return data;
}

export const fetchPurchases = async () => {
  const url = `${BASE_URL}/purchase`;
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
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 201) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 201,
      message: 'Cliente registrado com sucesso'
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}

export const registerProduct = async (product) => {
  const url = `${BASE_URL}/product`;
  const options = {
    method: 'POST',
    body: JSON.stringify(product)
  }
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 201) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 201,
      message: 'Produto registrado com sucesso'
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}

export const registerPurchase = async (purchase) => {
  const url = `${BASE_URL}/purchase`;
  const options = {
    method: 'POST',
    body: JSON.stringify(purchase)
  }
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 201) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 201,
      message: 'Compra registrada com sucesso'
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}

export const editPurchase = async (purchase, id) => {
  const url = `${BASE_URL}/purchase/${id}`;
  const options = {
    method: 'PUT',
    body: JSON.stringify(purchase)
  }
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 200) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 200,
      message: 'Compra editada com sucesso'
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}

export const editProduct = async (product, id) => {
  const url = `${BASE_URL}/product/${id}`;
  const options = {
    method: 'PUT',
    body: JSON.stringify(product)
  }
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 200) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 200,
      message: 'Produto editado com sucesso'
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}

export const editClient = async (client, id) => {
  const url = `${BASE_URL}/client/${id}`;
  const options = {
    method: 'PUT',
    body: JSON.stringify(client)
  }
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 200) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 200,
      message: 'Cliente editado com sucesso'
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}

export const updateClientsPurchase = async (expirationInfo) => {
  const url = `${BASE_URL}/expiration`;
  const options = {
    method: 'POST',
    body: JSON.stringify(expirationInfo)
  }
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 200) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 201,
      message: 'Validades do cliente atualizadas com sucesso'
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}

export const deleteProduct = async (productId) => {
  const url = `${BASE_URL}/product/${productId}`;
  const options = {
    method: 'DELETE',
  }
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 200) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 200,
      message: 'Produto excluido com sucesso',
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}

export const deletePurchase = async (purchaseId) => {
  const url = `${BASE_URL}/purchase/${purchaseId}`;
  const options = {
    method: 'DELETE',
  }
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 200) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 200,
      message: 'Compra excluida com sucesso',
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}

export const deleteClient = async (clientId) => {
  const url = `${BASE_URL}/client/${clientId}`;
  const options = {
    method: 'DELETE',
  }
  try {
    const response = await fetch(url, options);
    const data = await response.json();
    if (response.status !== 200) {
      return {
        status: response.status,
        message: data.message
      }
    }
    return {
      status: 200,
      message: 'Cliente excluído com sucesso',
    };
  } catch (error) {
    return {
      status: 500,
      message: 'Algo deu errado'
    }
  }
}
