Rails.application.routes.draw do
  root to: 'home#index'

  get 'login',  to: 'user_sessions#new'
  post 'login', to: 'user_sessions#create'

  resources :users, only: %i[new create]
  resources :foods, only: %i[new index] do
    collection do
      get 'select', to: 'foods/select'
      get 'genre_select', to: 'foods/genre'
    end
  end
end
