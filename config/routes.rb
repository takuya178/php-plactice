Rails.application.routes.draw do
  root to: 'home#index'

  get 'login',  to: 'user_sessions#new'
  post 'login', to: 'user_sessions#create'
  # get 'select', to: 'selects#index'

  get 'result', to: 'foods#result'

  resources :users, only: %i[new create]
  resources :foods, only: %i[new index] do
    collection do
      get 'select', to: 'foods/select'
    end
  end

  get 'foods', to: 'foods#index'
end
