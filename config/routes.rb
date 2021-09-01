Rails.application.routes.draw do
  root to: 'home#index'

  get 'login',  to: 'user_sessions#new'
  post 'login', to: 'user_sessions#create'
  get 'result', to: 'foods#result'
  get 'select', to: 'foods#select'

  resources :users, only: %i[new create]
  resources :foods, only: %i[new select] do
    collection do
      get 'genre_select', to: 'foods/genre'
    end
  end
end
